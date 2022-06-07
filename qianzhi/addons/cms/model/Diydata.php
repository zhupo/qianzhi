<?php

namespace addons\cms\model;

use think\Model;

class Diydata extends Model
{

    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';

    public $diyform = null;
    protected static $config = [];

    protected static function init()
    {
        $config = get_addon_config('cms');
        self::$config = $config;
    }

    public function __construct($data = [], $diyform = null)
    {
        static $diyformModel;
        if (is_null($diyformModel)) {
            $diyformModel = $diyform;
        }
        $this->diyform = $diyformModel;
        $this->name = $diyformModel['table'];
        return parent::__construct($data);
    }

    public function getUrlAttr($value, $data)
    {
        return addon_url('cms/diyform/show', [':diyname' => $this->diyform->diyname, ':id' => $data['id']], static::$config['urlsuffix']);
    }

    public function getFullurlAttr($value, $data)
    {
        return addon_url('cms/diyform/show', [':diyname' => $this->diyform->diyname, ':id' => $data['id']], static::$config['urlsuffix'], true);
    }

    public function getStatusList()
    {
        return ['normal' => __('Normal'), 'hidden' => __('Hidden'), 'rejected' => __('Rejected')];
    }

    public function getStatusTextAttr($value, $data)
    {
        $value = $value ? $value : $data['status'];
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }

}
