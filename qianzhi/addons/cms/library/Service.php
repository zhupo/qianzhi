<?php

namespace addons\cms\library;

use addons\cms\library\aip\AipContentCensor;
use addons\cms\library\aip\AipNlp;
use addons\cms\model\Autolink;
use addons\cms\model\Fields;
use addons\cms\model\Tag;
use fast\Http;
use think\Cache;
use think\Config;
use think\Db;
use think\Hook;

class Service
{

    /**
     * 检测内容是否合法
     * @param string $content 检测内容
     * @param string $type    类型
     * @return bool
     */
    public static function isContentLegal($content, $type = null)
    {
        $config = get_addon_config('cms');
        $type = is_null($type) ? $config['audittype'] : $type;
        if ($type == 'local') {
            // 敏感词过滤
            $handle = SensitiveHelper::init()->setTreeByFile(ADDON_PATH . 'cms/data/words.dic');
            //首先检测是否合法
            $isLegal = $handle->islegal($content);
            return $isLegal ? true : false;
        } elseif ($type == 'baiduyun') {
            $client = new AipContentCensor($config['aip_appid'], $config['aip_apikey'], $config['aip_secretkey']);
            $result = $client->textCensorUserDefined($content);
            if (!isset($result['conclusionType']) || $result['conclusionType'] > 1) {
                return false;
            }
        }
        return true;
    }

    /**
     * 获取标题的关键字
     * @param $title
     * @return array
     */
    public static function getContentTags($title)
    {
        $arr = [];
        $config = get_addon_config('cms');
        if ($config['nlptype'] == 'local') {
            !defined('_VIC_WORD_DICT_PATH_') && define('_VIC_WORD_DICT_PATH_', ADDON_PATH . 'cms/data/dict.json');
            $handle = new VicWord('json');
            $result = $handle->getAutoWord($title);
            foreach ($result as $index => $item) {
                $arr[] = $item[0];
            }
        } else {
            $client = new AipNlp($config['aip_appid'], $config['aip_apikey'], $config['aip_secretkey']);
            $result = $client->lexer($title);
            if (isset($result['items'])) {
                foreach ($result['items'] as $index => $item) {
                    if (!in_array($item['pos'], ['v', 'vd', 'nd', 'a', 'ad', 'an', 'd', 'm', 'q', 'r', 'p', 'c', 'u', 'xc', 'w'])) {
                        $arr[] = $item['item'];
                    }
                }
            }
        }
        foreach ($arr as $index => $item) {
            if (mb_strlen($item) == 1) {
                unset($arr[$index]);
            }
        }
        return array_filter(array_unique($arr));
    }

    /**
     * 内容关键字自动加链接
     * 优先顺序为 站点配置自动链接 > 自动链接表 > 标签内链
     */
    public static function autolinks($content)
    {
        $links = [];

        //先移除已有的自动链接
        $content = preg_replace_callback('~<a data\-rel="autolink" .*?>(.*?)</a>~i', function ($match) {
            return $match[1];
        }, $content);

        //存储所有标签
        $content = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) {
            return '<' . array_push($links, $match[1]) . '>';
        }, $content);

        $config = get_addon_config('cms');
        $limit = 2; //单一标签最大替换次数
        $redirect = true; //是否是用跳转
        $autolinkArr = [];
        $tagList = Tag::where('autolink', 1)->where('status', 'normal')->select();
        foreach ($tagList as $index => $item) {
            $autolinkArr[$item['name']] = ['text' => $item['name'], 'type' => 'tag', 'url' => addon_url('cms/tag/index', [':name' => $item['name'], ':id' => $item['id']], $config['urlsuffix'], true)];
        }
        $autolinkList = Autolink::where('status', 'normal')->order('weigh DESC,id DESC')->select();
        foreach ($autolinkList as $index => $item) {
            $autolinkArr[$item['title']] = ['text' => $item['title'], 'type' => 'autolink', 'url' => $item['url'], 'target' => $item['target'], 'id' => $item['id']];
        }
        foreach ($config['autolinks'] as $text => $url) {
            $autolinkArr[$text] = ['text' => $text, 'type' => 'config', 'url' => $url];
        }

        $autolinkArr = array_values($autolinkArr);
        //字符串长的优先替换
        usort($autolinkArr, function ($a, $b) {
            if ($a['text'] == $b['text']) return 0;
            return (strlen($a['text']) > strlen($b['text'])) ? -1 : 1;
        });

        //替换链接
        foreach ($autolinkArr as $index => $item) {
            $content = preg_replace_callback('/(' . $item['text'] . ')/i', function ($match) use ($item, $redirect, $config) {
                if ($item['type'] == 'tag') {
                    $url = $item['url'];
                } elseif ($item['type'] == 'autolink' || $redirect) {
                    $params = [];
                    $params['url'] = $item['url'];
                    if (isset($item['id'])) {
                        $params['id'] = $item['id'];
                    }
                    $url = addon_url('cms/go/index', [], $config['urlsuffix'], true) . '?' . http_build_query($params);
                } else {
                    $url = $item['url'];
                }
                return '<a data-rel="autolink" href="' . $url . '" ' . (isset($item['target']) && $item['target'] == 'blank' ? ' target="_blank"' : '') . '>' . $match[0] . '</a>';
            }, $content, $limit);

            $content = preg_replace_callback('~(<a .*?>.*?</a>)~i', function ($match) use (&$links) {
                return '<' . array_push($links, $match[1]) . '>';
            }, $content);
        }

        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) {
            return $links[$match[1] - 1];
        }, $content);
    }

    /**
     * 推送消息通知
     * @param string $content     内容
     * @param string $type        类型
     * @param string $template_id 模板ID
     */
    public static function notice($content, $type, $template_id)
    {
        try {
            if ($type == 'dinghorn') {
                Hook::listen('msg_notice', $template_id, [
                    'content' => $content
                ]);
            } elseif ($type == 'vbot') {
                Hook::listen('vbot_send_msg', $template_id, [
                    'content' => $content
                ]);
            }
        } catch (\Exception $e) {

        }
    }

    /**
     * 获取表字段信息
     * @param string $table 表名
     * @return array
     */
    public static function getTableFields($table)
    {
        $tagName = "cms-table-fields-{$table}";
        $fieldlist = Cache::get($tagName);
        if (!Config::get('app_debug') && $fieldlist) {
            return $fieldlist;
        }
        $dbname = Config::get('database.database');
        //从数据库中获取表字段信息
        $sql = "SELECT * FROM `information_schema`.`columns` WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? ORDER BY ORDINAL_POSITION";
        //加载主表的列
        $columnList = Db::query($sql, [$dbname, $table]);
        $fieldlist = [];
        foreach ($columnList as $index => $item) {
            $fieldlist[] = ['name' => $item['COLUMN_NAME'], 'title' => $item['COLUMN_COMMENT'], 'type' => $item['DATA_TYPE']];
        }
        Cache::set($tagName, $fieldlist);
        return $fieldlist;
    }

    /**
     * 获取指定类型的自定义字段列表
     */
    public static function getCustomFields($source, $source_id, $values = [], $conditions = [])
    {
        $fields = Fields::where('source', $source)
            ->where('source_id', $source_id)
            ->where($conditions)
            ->where('status', 'normal')
            ->order('weigh desc,id desc')
            ->select();
        foreach ($fields as $k => $v) {
            //优先取编辑的值,再次取默认值
            $v->value = isset($values[$v['name']]) ? $values[$v['name']] : (is_null($v['defaultvalue']) ? '' : $v['defaultvalue']);
            $v->rule = str_replace(',', '; ', $v->rule);
            if (in_array($v['type'], ['checkbox', 'lists', 'images'])) {
                $checked = '';
                if ($v['minimum'] && $v['maximum']) {
                    $checked = "{$v['minimum']}~{$v['maximum']}";
                } elseif ($v['minimum']) {
                    $checked = "{$v['minimum']}~";
                } elseif ($v['maximum']) {
                    $checked = "~{$v['maximum']}";
                }
                if ($checked) {
                    $v->rule .= (';checked(' . $checked . ')');
                }
            }
            if (in_array($v['type'], ['checkbox', 'radio']) && stripos($v->rule, 'required') !== false) {
                $v->rule = str_replace('required', 'checked', $v->rule);
            }
            if (in_array($v['type'], ['selects'])) {
                $v->extend .= (' ' . 'data-max-options="' . $v['maximum'] . '"');
            }
        }

        return $fields;
    }

    /**
     * 获取过滤列表
     * @param string $source
     * @param int    $source_id
     * @param array  $filter
     * @param array  $params
     * @param bool   $multiple 是否为复选模式
     * @return array
     */
    public static function getFilterList($source, $source_id, $filter, $params = [], $multiple = false)
    {
        $fieldsList = Fields::where('source', $source)
            ->where('source_id', $source_id)
            ->where('status', 'normal')
            ->cache(true)
            ->select();

        //$fieldsList = [];
        $filterList = [];
        $multiValueFields = [];
        $listFields = Fields::getListFields();
        //foreach ($list as $index => $item) {
        //    if (in_array($item['type'], $listFields)) {
        //        $fieldsList[$item['name']] = $item['content_list'];
        //    }
        //}

        $fields = [];
        foreach ($fieldsList as $k => $v) {
            if (!$v['isfilter'] || !$v['content_list']) {
                continue;
            }
            //多选值字段需要做特殊处理
            if (in_array($v['type'], ['selects', 'checkbox', 'array', 'selectpages'])) {
                $multiValueFields[] = $v['name'];
            }
            $fields[] = [
                'name'    => $v['name'],
                'title'   => $v['title'],
                'content' => $v['content_list']
            ];
        }
        $filter = array_intersect_key($filter, array_flip(array_column($fields, 'name')));
        foreach ($fields as $k => $v) {
            $content = [];
            $all = ['' => __('All')] + $v['content'];
            foreach ($all as $m => $n) {
                $filterArr = isset($filter[$v['name']]) && $filter[$v['name']]!=='' ? explode(',', $filter[$v['name']]) : [];
                $active = ($m === '' && !$filterArr) || ($m !== '' && in_array($m, $filterArr)) ? true : false;
                if ($active) {
                    $current = implode(',', array_diff($filterArr, [$m]));
                } else {
                    $current = $multiple ? implode(',', array_merge($filterArr, [$m])) : $m;
                }
                $prepare = $m === '' ? array_diff_key($filter, [$v['name'] => $m]) : array_merge($filter, [$v['name'] => $current]);
                //$url = '?' . http_build_query(array_merge(['filter' => $prepare], array_diff_key($params, ['filter' => ''])));
                $url = '?' . str_replace('%2C', ',', http_build_query(array_merge($prepare, array_intersect_key($params, array_flip(['orderby', 'orderway', 'multiple'])))));
                $content[] = ['value' => $m, 'title' => $n, 'active' => $active, 'url' => $url];
            }

            $filterList[] = [
                'name'    => $v['name'],
                'title'   => $v['title'],
                'content' => $content,
            ];
        }
        return [$filterList, $filter, $params, $fields, $multiValueFields, $fieldsList];
    }

    /**
     * 获取排序列表
     * @param string $orderby
     * @param string $orderway
     * @param array  $orders
     * @param array  $params
     * @param array  $fieldsList
     * @return array
     */
    public static function getOrderList($orderby, $orderway, $orders = [], $params = [], $fieldsList = [])
    {
        $lastOrderby = '';
        $lastOrderway = $orderway && in_array(strtolower($orderway), ['asc', 'desc']) ? $orderway : 'desc';

        foreach ($fieldsList as $index => $field) {
            if ($field['isorder']) {
                $orders[] = ['name' => $field['name'], 'field' => $field['name'], 'title' => $field['title']];
            }
        }

        $orderby = in_array($orderby, array_map(function ($item) {
            return $item['name'];
        }, $orders)) ? $orderby : 'default';

        foreach ($orders as $index => $order) {
            if ($orderby == $order['name']) {
                $lastOrderby = $order['field'];
                break;
            }
        }

        $orderList = [];
        foreach ($orders as $k => $v) {
            $url = '?' . http_build_query(array_merge($params, ['orderby' => $v['name'], 'orderway' => $v['name'] == $orderby ? ($lastOrderway == 'desc' ? 'asc' : 'desc') : 'desc']));
            $v['active'] = $orderby == $v['name'] ? true : false;
            $v['url'] = $url;
            $orderList[] = $v;
        }

        return [$orderList, $lastOrderby, $lastOrderway];
    }

    /**
     * 追加_text属性值
     * @param $fieldsContentList
     * @param $row
     */
    public static function appendTextAttr(&$fieldsContentList, &$row)
    {
        //附加列表字段
        array_walk($fieldsContentList, function ($content, $field) use (&$row) {
            if (isset($row[$field])) {
                if (isset($content[$row[$field]])) {
                    $list = [$row[$field] => $content[$row[$field]]];
                } else {
                    $keys = $values = explode(',', $row[$field]);
                    foreach ($values as $index => &$item) {
                        $item = isset($content[$item]) ? $content[$item] : $item;
                    }
                    $list = array_combine($keys, $values);
                }
            } else {
                $list = [];
            }
            $list = array_filter($list);
            $row[$field . '_text'] = implode(',', $list);
            $row[$field . '_list'] = $list;
        });
    }
}
