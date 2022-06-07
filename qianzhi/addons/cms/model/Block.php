<?php

namespace addons\cms\model;

use addons\cms\library\Service;
use think\Db;
use think\Model;
use think\View;

/**
 * 区块模型
 */
class Block extends Model
{
    protected $name = "cms_block";
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = '';
    protected $updateTime = '';
    // 追加属性
    protected $append = [
    ];
    protected static $config = [];

    protected static $tagCount = 0;

    protected static function init()
    {
        $config = get_addon_config('cms');
        self::$config = $config;
    }

    public function getImageAttr($value, $data)
    {
        $value = $value ? $value : self::$config['default_block_img'];
        return cdnurl($value);
    }

    public function getContentAttr($value, $data)
    {
        if (isset($data['parsetpl']) && $data['parsetpl']) {
            $view = View::instance();
            $view->engine->layout(false);
            return $view->display($data['content']);
        }
        return $data['content'];
    }

    public function getHasimageAttr($value, $data)
    {
        return $this->getData("image") ? true : false;
    }

    /**
     * 获取区块列表
     * @param $params
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getBlockList($params)
    {
        $config = get_addon_config('cms');
        $name = empty($params['name']) ? '' : $params['name'];
        $condition = empty($params['condition']) ? '' : $params['condition'];
        $field = empty($params['field']) ? '*' : $params['field'];
        $row = empty($params['row']) ? 10 : (int)$params['row'];
        $orderby = empty($params['orderby']) ? 'id' : $params['orderby'];
        $orderway = empty($params['orderway']) ? 'desc' : strtolower($params['orderway']);
        $limit = empty($params['limit']) ? $row : $params['limit'];
        $cache = !isset($params['cache']) ? $config['cachelifetime'] === 'true' ? true : (int)$config['cachelifetime'] : (int)$params['cache'];
        $imgwidth = empty($params['imgwidth']) ? '' : $params['imgwidth'];
        $imgheight = empty($params['imgheight']) ? '' : $params['imgheight'];
        $orderway = in_array($orderway, ['asc', 'desc']) ? $orderway : 'desc';
        $paginate = !isset($params['paginate']) ? false : $params['paginate'];
        $cache = !$cache ? false : $cache;

        self::$tagCount++;

        $where = ['status' => 'normal'];
        if ($name !== '') {
            $where['name'] = $name;
        }
        $order = $orderby == 'rand' ? Db::raw('rand()') : (preg_match("/\,|\s/", $orderby) ? $orderby : "{$orderby} {$orderway}");
        $order = $orderby == 'weigh' ? $order . ',id DESC' : $order;

        $blockModel = self::where($where)
            ->where($condition)
            ->field($field)
            ->orderRaw($order);

        if ($paginate) {
            $paginateArr = explode(',', $paginate);
            $listRows = is_numeric($paginate) ? $paginate : (is_numeric($paginateArr[0]) ? $paginateArr[0] : $row);
            $config = [];
            $config['var_page'] = isset($paginateArr[2]) ? $paginateArr[2] : 'bpage' . self::$tagCount;
            $config['path'] = isset($paginateArr[3]) ? $paginateArr[3] : '';
            $config['fragment'] = isset($paginateArr[4]) ? $paginateArr[4] : '';
            $config['query'] = request()->get();
            $list = $blockModel->paginate($listRows, (isset($paginateArr[1]) ? $paginateArr[1] : false), $config);
        } else {
            $list = $blockModel->limit($limit)->cache($cache)->select();
        }

        $fieldsContentList = Fields::getFieldsContentList('block');
        foreach ($list as $index => $item) {
            Service::appendTextAttr($fieldsContentList, $item);
            // zjs新增
            if($item['intro']){
                $list[$index]['intro'] = json_decode($item['intro'], true);
            }
           
        }

        self::render($list, $imgwidth, $imgheight);
        return $list;
    }

    public static function render(&$list, $imgwidth, $imgheight)
    {
        $width = $imgwidth ? 'width="' . $imgwidth . '"' : '';
        $height = $imgheight ? 'height="' . $imgheight . '"' : '';
        $time = time();
        foreach ($list as $k => &$v) {
            if (($v['begintime'] && $time < $v['begintime']) || ($v['endtime'] && $time > $v['endtime'])) {
                unset($list[$k]);
                continue;
            }
            $v['textlink'] = '<a href="' . $v['url'] . '">' . $v['title'] . '</a>';
            $v['imglink'] = '<a href="' . $v['url'] . '"><img src="' . $v['image'] . '" border="" ' . $width . ' ' . $height . ' /></a>';
            $v['img'] = '<img src="' . $v['image'] . '" border="" ' . $width . ' ' . $height . ' />';
        }
        return $list;
    }
    
    
    

    /**
     * 获取区块内容
     * @param $params
     * @return mixed|string
     */
    public static function getBlockContent($params)
    {
        $fieldName = isset($params['id']) ? 'id' : 'name';
        $value = isset($params[$fieldName]) ? $params[$fieldName] : '';
        $field = isset($params['field']) ? $params['field'] : '';
        $cache = !isset($params['cache']) ? true : (int)$params['cache'];
        $cache = !$cache ? false : $cache;

        $row = self::where($fieldName, $value)
            ->where('status', 'normal')
            ->cache($cache)
            ->find();
        $result = '';
        if ($row) {

            $fieldsContentList = Fields::getFieldsContentList('block');
            Service::appendTextAttr($fieldsContentList, $row);

            $time = time();
            if (($row['begintime'] && $time < $row['begintime']) || ($row['endtime'] && $time > $row['endtime'])) {
                return $result;
            }
            if ($field && isset($row[$field])) {
                return $row[$field];
            }
            if ($row['content']) {
                $result = $row['content'];
            } elseif ($row['image']) {
                $result = '<img src="' . $row['image'] . '" class="img-responsive"/>';
            } else {
                $result = $row['title'];
            }
            if ($row['url'] && !$row['content']) {
                $result = $row['url'] ? '<a href="' . (preg_match("/^https?:\/\/(.*)/i", $row['url']) ? $row['url'] : url($row['url'])) . '">' . $result . '</a>' : $result;
            }
        }
        return $result;
    }
}
