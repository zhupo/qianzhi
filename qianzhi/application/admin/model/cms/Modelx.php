<?php

namespace app\admin\model\cms;

use think\Config;
use think\Db;
use think\Exception;
use think\Model;

class Modelx extends Model
{

    // 表名
    protected $name = 'cms_model';
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';
    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = 'updatetime';
    // 追加属性
    protected $append = [
    ];

    public static function init()
    {
        self::beforeInsert(function ($row) {
            $row['setting'] = '{"contributefields":["image","tags","content"]}';
            if (!preg_match("/^([a-z0-9_]+)$/", $row['table'])) {
                throw new Exception("表名只支持小写字母、数字、下划线");
            }
        });
        self::afterInsert(function ($row) {
            $prefix = Config::get('database.prefix');
            $sql = "CREATE TABLE `{$prefix}{$row['table']}` (`id` int(10) NOT NULL,`content` longtext NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='{$row['name']}'";
            Db::execute($sql);

            if (isset($row['modelname']) && in_array($row['modelname'], ['download', 'news', 'product'])) {
                $time = time();
                $modelSqlArr = [
                    'download' => "ALTER TABLE `{$prefix}{$row['table']}` ADD (`os` set('windows','linux','mac','ubuntu') DEFAULT '' COMMENT '操作系统',`version` varchar(255) DEFAULT '' COMMENT '最新版本',`filesize` varchar(255) DEFAULT '' COMMENT '文件大小',`language` set('zh-cn','en') DEFAULT '' COMMENT '语言',`downloadurl` varchar(1500) DEFAULT '' COMMENT '下载地址',`screenshots` varchar(1500) DEFAULT '' COMMENT '预览截图',`price` decimal(10,2) DEFAULT '0.00' COMMENT '价格',`downloads` varchar(10) DEFAULT '0' COMMENT '下载次数');",
                    "news"     => "ALTER TABLE `{$prefix}{$row['table']}` ADD (`author` varchar(50) DEFAULT '' COMMENT '作者',`price` decimal(10,2) DEFAULT '0.00' COMMENT '价格');",
                    "product"  => "ALTER TABLE `{$prefix}{$row['table']}` ADD (`productdata` varchar(1500) DEFAULT '' COMMENT '产品列表');",
                ];
                $modelFieldsArr = [
                    "download" => "os,version,filesize,language,downloadurl,screenshots,price,downloads",
                    "news"     => "author,price",
                    "product"  => "productdata",
                ];
                $modelInsertArr = [
                    "download" => [
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "os",
                            "type"         => "checkbox",
                            "title"        => "操作系统",
                            "content"      => "windows|Windows\r\nlinux|Linux\r\nmac|Mac\r\nubuntu|Ubuntu",
                            "length"       => 255,
                            "iscontribute" => 1,
                            "isfilter"     => 1,
                            "defaultvalue" => '',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "version",
                            "type"         => "string",
                            "title"        => "最新版本",
                            "content"      => "value1|title1\r\nvalue2|title2",
                            "length"       => 255,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => '',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "filesize",
                            "type"         => "string",
                            "title"        => "文件大小",
                            "content"      => "value1|title1\r\nvalue2|title2",
                            "length"       => 255,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => '',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "language",
                            "type"         => "checkbox",
                            "title"        => "语言",
                            "content"      => "zh-cn|中文\r\nen|英文",
                            "length"       => 255,
                            "iscontribute" => 1,
                            "isfilter"     => 1,
                            "defaultvalue" => '',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "downloadurl",
                            "type"         => "array",
                            "title"        => "下载地址",
                            "content"      => "local|本地下载地址\r\nbaidu|百度网盘地址",
                            "length"       => 1500,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => '',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "downloads",
                            "type"         => "string",
                            "title"        => "下载地址",
                            "content"      => "value1|title1\r\nvalue2|title2",
                            "length"       => 10,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => '0',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "screenshots",
                            "type"         => "images",
                            "title"        => "预览截图",
                            "content"      => "value1|title1\r\nvalue2|title2",
                            "length"       => 1500,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => '',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "price",
                            "type"         => "number",
                            "title"        => "价格",
                            "content"      => "value1|title1\r\nvalue2|title2",
                            "length"       => 10,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => 0,
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                    ],
                    "news"     => [
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "author",
                            "type"         => "string",
                            "title"        => "作者",
                            "content"      => "value1|title1\r\nvalue2|title2",
                            "length"       => 255,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => '',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "price",
                            "type"         => "number",
                            "title"        => "价格",
                            "content"      => "value1|title1\r\nvalue2|title2",
                            "length"       => 10,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => 0,
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                    ],
                    "product"  => [
                        [
                            "source"       => "model",
                            "source_id"    => $row['id'],
                            "name"         => "productdata",
                            "type"         => "images",
                            "title"        => "产品列表",
                            "content"      => "value1|title1\r\nvalue2|title2",
                            "length"       => 1500,
                            "iscontribute" => 1,
                            "isfilter"     => 0,
                            "defaultvalue" => '',
                            "createtime"   => $time,
                            "updatetime"   => $time,
                            "status"       => "normal"
                        ],
                    ],
                ];
                Db::name("cms_fields")->insertAll($modelInsertArr[$row['modelname']]);
                Db::execute($modelSqlArr[$row['modelname']]);
                $row->save(['fields' => $modelFieldsArr[$row['modelname']]]);
            }
        });
        //存在栏目无法删除
        self::beforeDelete(function ($row) {
            $exist = Channel::where('model_id', $row['id'])->find();
            if ($exist) {
                throw new Exception("模型下存在栏目，无法进行删除");
            }
        });
        //删除模型后删除对应的表字段
        self::afterDelete(function ($row) {
            Db::name("cms_fields")->where(['source' => 'model', 'source_id' => $row['id']])->delete();
        });
    }

    public function getFieldsAttr($value, $data)
    {
        return is_array($value) ? $value : ($value ? explode(',', $value) : []);
    }

    public function getSettingAttr($value, $data)
    {
        return is_array($value) ? $value : (array)json_decode($data['setting'], true);
    }

    public function setSettingAttr($value)
    {
        return is_array($value) ? json_encode($value) : $value;
    }
}
