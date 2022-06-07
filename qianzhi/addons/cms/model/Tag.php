<?php

namespace addons\cms\model;

use think\Db;
use think\Model;

/**
 * 标签模型
 */
class Tag extends Model
{
    protected $name = "cms_tag";
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = '';
    protected $updateTime = '';
    // 追加属性
    protected $append = [
        'url',
        'fullurl'
    ];

    protected static $config = [];

    protected static $tagCount = 0;

    protected static function init()
    {
        $config = get_addon_config('cms');
        self::$config = $config;
    }

    public function model()
    {
        return $this->belongsTo("Modelx");
    }

    public function getUrlAttr($value, $data)
    {
        $name = $data['name'] ? $data['name'] : $data['id'];
        return addon_url('cms/tag/index', [':id' => $data['id'], ':name' => $name], static::$config['urlsuffix']);
    }

    public function getFullurlAttr($value, $data)
    {
        $name = $data['name'] ? $data['name'] : $data['id'];
        return addon_url('cms/tag/index', [':id' => $data['id'], ':name' => $name], static::$config['urlsuffix'], true);
    }

    /**
     * 获取标签列表
     * @param $tag
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getTagList($tag)
    {
        $config = get_addon_config('cms');
        $condition = empty($tag['condition']) ? '' : $tag['condition'];
        $field = empty($tag['field']) ? '*' : $tag['field'];
        $row = empty($tag['row']) ? 10 : (int)$tag['row'];
        $orderby = empty($tag['orderby']) ? 'nums' : $tag['orderby'];
        $orderway = empty($tag['orderway']) ? 'desc' : strtolower($tag['orderway']);
        $limit = empty($tag['limit']) ? $row : $tag['limit'];
        $cache = !isset($tag['cache']) ? $config['cachelifetime'] === 'true' ? true : (int)$config['cachelifetime'] : (int)$tag['cache'];
        $orderway = in_array($orderway, ['asc', 'desc']) ? $orderway : 'desc';
        $paginate = !isset($tag['paginate']) ? false : $tag['paginate'];
        $cache = !$cache ? false : $cache;

        self::$tagCount++;

        $where = [];

        $order = $orderby == 'rand' ? Db::raw('rand()') : (preg_match("/\,|\s/", $orderby) ? $orderby : "{$orderby} {$orderway}");

        $tagModel = self::where($where)
            ->where($condition)
            ->field($field)
            ->orderRaw($order);

        if ($paginate) {
            $paginateArr = explode(',', $paginate);
            $listRows = is_numeric($paginate) ? $paginate : (is_numeric($paginateArr[0]) ? $paginateArr[0] : $row);
            $config = [];
            $config['var_page'] = isset($paginateArr[2]) ? $paginateArr[2] : 'tpage' . self::$tagCount;
            $config['path'] = isset($paginateArr[3]) ? $paginateArr[3] : '';
            $config['fragment'] = isset($paginateArr[4]) ? $paginateArr[4] : '';
            $config['query'] = request()->get();
            $list = $tagModel->paginate($listRows, (isset($paginateArr[1]) ? $paginateArr[1] : false), $config);
        } else {
            $list = $tagModel->limit($limit)->cache($cache)->select();
        }

        foreach ($list as $k => $v) {
            $v['textlink'] = '<a href="' . $v['url'] . '">' . $v['name'] . '</a>';
        }
        return $list;
    }

    /**
     * 刷新标签
     * @param string $tags        标签,多个标签以,分隔
     * @param int    $archives_id 文档ID
     * @return bool
     */
    public static function refresh($tags, $archives_id)
    {
        $field = "nums";
        $tags = str_replace('，', ',', $tags);
        $tagsArr = explode(',', $tags);
        $tagsArr = array_unique(array_filter(array_map('strtolower', $tagsArr)));

        //取出所有标签列表
        $tagsList = Tag::alias('t')
            ->join('cms_taggable ta', 'ta.tag_id = t.id', 'RIGHT')
            ->where('ta.archives_id', $archives_id)
            ->field('t.*,ta.archives_id,ta.id AS taggable_id')
            ->select();
        foreach ($tagsList as $index => $item) {
            $item['name'] = strtolower($item['name']);
            if (!in_array($item['name'], $tagsArr)) {
                //统计减1
                isset($item[$field]) && $item->setDec($field);
                //删除标签
                Taggable::where('id', $item['taggable_id'])->delete();
            } else {
                $tagsArr = array_diff($tagsArr, [$item['name']]);
            }
        }
        if (!$tagsArr) {
            return true;
        }
        $insertTagIds = [];
        //取出剩余标签
        $tagList = self::where('name', 'in', $tagsArr)->select();
        foreach ($tagList as $index => $item) {
            $item['name'] = strtolower($item['name']);
            $item->setInc($field);
            $tagsArr = array_diff($tagsArr, [$item['name']]);
            $insertTagIds[] = $item['id'];
        }
        //剩余未插入的话题
        if ($tagsArr) {
            $originTagsArr = explode(',', $tags);
            foreach ($originTagsArr as $index => $item) {
                $name = strtolower($item);
                if (in_array($name, $tagsArr)) {
                    $tagsArr = array_diff($tagsArr, [$name]);
                    $object = self::create(['name' => $item, $field => 1]);
                    $id = $object->id;
                    $insertTagIds[] = $id;
                }
            }
        }
        //插入到taggable表
        $insertList = [];
        foreach ($insertTagIds as $index => $tag_id) {
            $insertList[] = ['tag_id' => $tag_id, 'archives_id' => $archives_id, 'createtime' => time()];
        }
        if ($insertList) {
            (new Taggable())->insertAll($insertList);
        }
        return true;
    }
}
