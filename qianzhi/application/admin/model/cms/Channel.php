<?php

namespace app\admin\model\cms;

use think\Exception;
use think\Model;

class Channel extends Model
{

    // 表名
    protected $name = 'cms_channel';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 追加属性
    protected $append = [
        'type_text',
        'status_text',
        'url',
        'fullurl',
        'outlink',
    ];
    protected static $config = [];

    public function getUrlAttr($value, $data)
    {
        $diyname = $data['diyname'] ? $data['diyname'] : $data['id'];
        return isset($data['type']) && isset($data['outlink']) && $data['type'] == 'link' ? $this->getAttr('outlink') : addon_url('cms/channel/index', [':id' => $data['id'], ':diyname' => $diyname], static::$config['urlsuffix']);
    }

    public function getFullurlAttr($value, $data)
    {
        $diyname = $data['diyname'] ? $data['diyname'] : $data['id'];
        return isset($data['type']) && isset($data['outlink']) && $data['type'] == 'link' ? $this->getAttr('outlink') : addon_url('cms/channel/index', [':id' => $data['id'], ':diyname' => $diyname], static::$config['urlsuffix'], true);
    }

    public function getOutlinkAttr($value, $data)
    {
        $indexUrl = $view_replace_str = config('view_replace_str.__PUBLIC__');
        $indexUrl = rtrim($indexUrl, '/');
        return str_replace('__INDEX__', $indexUrl, $value);
    }

    protected static function init()
    {
        $config = static::$config = get_addon_config('cms');
        self::beforeInsert(function ($row) {
            if ($row->getData('type') == 'link') {
                $row->model_id = 0;
            }
        });
        self::beforeUpdate(function ($row) {
            if ($row['parent_id']) {
                $childrenIds = self::getChildrenIds($row['id'], true);
                if (in_array($row['parent_id'], $childrenIds)) {
                    throw new Exception("上级栏目不能是其自身或子栏目");
                }
            }
        });
        self::beforeWrite(function ($row) {
            //在更新之前对数组进行处理
            foreach ($row->getData() as $k => $value) {
                if (is_array($value) && is_array(reset($value))) {
                    $value = json_encode(self::getArrayData($value), JSON_UNESCAPED_UNICODE);
                } else {
                    $value = is_array($value) ? implode(',', $value) : $value;
                }
                $row->$k = $value;
            }
        });
        self::afterInsert(function ($row) {
            //创建时自动添加权重值
            $pk = $row->getPk();
            $row->getQuery()->where($pk, $row[$pk])->update(['weigh' => $row[$pk]]);
        });
        self::afterDelete(function ($row) {
            //删除时，删除子节点，同时将所有相关文档移入回收站
            $childIds = self::getChildrenIds($row['id']);
            if ($childIds) {
                Channel::destroy(function ($query) use ($childIds) {
                    $query->where('id', 'in', $childIds);
                });
            }
            $childIds[] = $row['id'];
            db('cms_archives')->where('channel_id', 'in', $childIds)->update(['deletetime' => time()]);
        });
        self::afterWrite(function ($row) use ($config) {
            $changed = $row->getChangedData();
            //隐藏时判断是否有子节点,有则隐藏
            if (isset($changed['status']) && $changed['status'] == 'hidden') {
                $childIds = self::getChildrenIds($row['id']);
                db('cms_channel')->where('id', 'in', $childIds)->update(['status' => 'hidden']);
            }
            //隐藏栏目显示时判断是否有子节点
            if (isset($changed['isnav']) && !$changed['isnav']) {
                $childIds = self::getChildrenIds($row['id']);
                db('cms_channel')->where('id', 'in', $childIds)->update(['isnav' => 0]);
            }

            if (isset($changed['status']) && $changed['status'] == 'normal') {
                //推送到熊掌号+百度站长
                if ($config['baidupush']) {
                    $urls = [$row->fullurl];
                    \think\Hook::listen("baidupush", $urls);
                }
            }
        });
    }

    public static function getTypeList()
    {
        return ['channel' => __('Channel'), 'list' => __('List'), 'link' => __('Link')];
    }

    public static function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden')];
    }

    public function getTypeTextAttr($value, $data)
    {
        $value = $value ? $value : $data['type'];
        $list = $this->getTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : $data['status'];
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

    /**
     * 获取栏目的所有子节点ID
     * @param int  $id       栏目ID
     * @param bool $withself 是否包含自身
     * @return array
     */
    public static function getChildrenIds($id, $withself = false)
    {
        static $tree;
        if (!$tree) {
            $tree = \fast\Tree::instance();
            $tree->init(collection(Channel::order('weigh desc,id desc')->field('id,parent_id,name,type,diyname,status')->select())->toArray(), 'parent_id');
        }
        $childIds = $tree->getChildrenIds($id, $withself);
        return $childIds;
    }

    public function model()
    {
        return $this->belongsTo('Modelx', 'model_id')->setEagerlyType(0);
    }
}
