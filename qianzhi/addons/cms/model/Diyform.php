<?php

namespace addons\cms\model;

use addons\cms\library\Service;
use think\Db;
use think\Model;

/**
 * 自定义表单模型
 */
class Diyform extends Model
{
    protected $name = "cms_diyform";
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = '';
    protected $updateTime = '';
    // 追加属性
    protected $append = [
        'url',
    ];
    protected static $config = [];

    protected static $tagCount = 0;

    protected static function init()
    {
        $config = get_addon_config('cms');
        self::$config = $config;
    }

    public function getUrlAttr($value, $data)
    {
        return addon_url('cms/diyform/index', [':diyname' => $data['diyname']], static::$config['urlsuffix']);
    }

    public function getFullurlAttr($value, $data)
    {
        return addon_url('cms/diyform/index', [':diyname' => $data['diyname']], static::$config['urlsuffix'], true);
    }

    public function getPosturlAttr($value, $data)
    {
        return addon_url('cms/diyform/post', [':diyname' => $data['diyname']], static::$config['urlsuffix']);
    }

    public function getSettingAttr($value, $data)
    {
        return is_array($value) ? $value : (array)json_decode($data['setting'], true);
    }

    public function setSettingAttr($value)
    {
        return is_array($value) ? json_encode($value) : $value;
    }

    public static function getDiyformFields($diyform_id, $values = [])
    {
        $fields = Service::getCustomFields('diyform', $diyform_id, $values, ['iscontribute' => 1]);
        return $fields;
    }

    public function getOrderFields()
    {
        $setting = $this->setting;
        $orderfields = isset($setting['orderfields']) ? $setting['orderfields'] : [];
        $orders = [
            ['name' => 'id', 'field' => 'id', 'title' => "ID"],
            ['name' => 'createtime', 'field' => 'createtime', 'title' => "添加时间"],
            ['name' => 'updatetime', 'field' => 'updatetime', 'title' => "更新时间"],
        ];

        return array_filter($orders, function ($item) use ($orderfields) {
            return in_array($item['name'], $orderfields);
        });
    }

    /**
     * 获取自定义表单数据列表
     * @param array $params
     * @return false|\PDOStatement|string|\think\Collection|array
     */
    public static function getDiydataList($params)
    {
        $config = get_addon_config('cms');
        $form = empty($params['form']) ? '' : $params['form'];
        $condition = empty($params['condition']) ? '' : $params['condition'];
        $field = empty($params['field']) ? '*' : $params['field'];
        $row = empty($params['row']) ? 10 : (int)$params['row'];
        $orderby = empty($params['orderby']) ? 'createtime' : $params['orderby'];
        $orderway = empty($params['orderway']) ? 'desc' : strtolower($params['orderway']);
        $limit = empty($params['limit']) ? $row : $params['limit'];
        $cache = !isset($params['cache']) ? $config['cachelifetime'] === 'true' ? true : (int)$config['cachelifetime'] : (int)$params['cache'];
        $orderway = in_array($orderway, ['asc', 'desc']) ? $orderway : 'desc';
        $paginate = !isset($params['paginate']) ? false : $params['paginate'];

        self::$tagCount++;

        $where = [];
        $diyform = null;
        $diyform = Diyform::where("id", $form)->cache($cache)->find();
        if (!$diyform) {
            return [];
        }
        $order = $orderby == 'rand' ? Db::raw('rand()') : (preg_match("/\,|\s/", $orderby) ? $orderby : "{$orderby} {$orderway}");

        $diyformModel = (new Diydata([], $diyform))->where($where)
            ->where($condition)
            ->field($field)
            ->orderRaw($order);

        if ($paginate) {
            $paginateArr = explode(',', $paginate);
            $listRows = is_numeric($paginate) ? $paginate : (is_numeric($paginateArr[0]) ? $paginateArr[0] : $row);
            $config = [];
            $config['var_page'] = isset($paginateArr[2]) ? $paginateArr[2] : 'dpage' . self::$tagCount;
            $config['path'] = isset($paginateArr[3]) ? $paginateArr[3] : '';
            $config['fragment'] = isset($paginateArr[4]) ? $paginateArr[4] : '';
            $config['query'] = request()->get();
            $list = $diyformModel->paginate($listRows, (isset($paginateArr[1]) ? $paginateArr[1] : false), $config);
        } else {
            $list = $diyformModel->limit($limit)->cache($cache)->select();
        }
        return $list;
    }
}
