<?php

namespace addons\cms\controller;

use addons\cms\library\Service;
use addons\cms\model\Archives;
use addons\cms\model\Channel as ChannelModel;
use addons\cms\model\Fields;
use addons\cms\model\Modelx;
use think\Config;

/**
 * 栏目控制器
 * Class Channel
 * @package addons\cms\controller
 */
class Channel extends Base
{
    public function index()
    {
        $config = get_addon_config('cms');

        $diyname = $this->request->param('diyname');

        if ($diyname && !is_numeric($diyname)) {
            $channel = ChannelModel::getByDiyname($diyname);
        } else {
            $id = $diyname ? $diyname : $this->request->param('id', '');
            $channel = ChannelModel::get($id);
        }
        if (!$channel) {
            $this->error(__('No specified channel found'));
        }

        $filter = $this->request->get('filter/a', []);
        $seach = $this->request->get('title', ''); //新增 标题查询 start 1
        $orderby = $this->request->get('orderby', '');
        $orderway = $this->request->get('orderway', '', 'strtolower');
        $multiple = $this->request->get('multiple/d', 0);

        $params = [];
        $filter = $this->request->get();
        $filter = array_diff_key($filter, array_flip(['orderby', 'orderway', 'page', 'multiple']));
        if (isset($filter['filter'])) {
            $filter = array_merge($filter, $filter['filter']);
        }
        if ($filter) {
            $filter = array_filter($filter, 'strlen');
            $params['filter'] = $filter;
            $params = $filter;
        }
        //新增 标题查询 start 2
        if ($seach) {
            $condition['title'] = ["like", "%$seach%"];
            $this->assign('t', $seach);
        }else{
            $condition['a.id'] = ['>=', 0];
        }
        //新增 标题查询 end
        if ($orderby) {
            $params['orderby'] = $orderby;
        }
        if ($orderway) {
            $params['orderway'] = $orderway;
        }
        if ($multiple) {
            $params['multiple'] = $multiple;
        }
        if ($channel['type'] === 'link') {
            $this->redirect($channel['outlink']);
        }

        //加载模型数据
        $model = Modelx::get($channel['model_id']);
        if (!$model) {
            $this->error(__('No specified model found'));
        }

        //默认排序字段
        $orders = [
            ['name' => 'default', 'field' => 'weigh DESC,publishtime DESC', 'title' => __('Default')],
        ];
       

        //合并主表筛选字段
        $orders = array_merge($orders, $model->getOrderFields());

        //获取过滤列表
        list($filterList, $filter, $params, $fields, $multiValueFields, $fieldsList) = Service::getFilterList('model', $model['id'], $filter, $params, $multiple);

        //设置副表的搜索字段
        foreach ($fieldsList as $index => $item) {
            if ($item['isorder']) {
                $orders[] = ['name' => $item['name'], 'field' => $item['name'], 'title' => $item['title']];
            }
        }

        //获取排序列表
        list($orderList, $orderby, $orderway) = Service::getOrderList($orderby, $orderway, $orders, $params);

        //构造bind数据
        // $bind = [];
        // foreach ($filter as $field => &$item) {
        //     $item = !is_array($item) && stripos($item, ',') !== false ? explode(',', $item) : $item;
        //     if (is_array($item)) {
        //         foreach ($item as $index => $subitem) {
        //             $bind[$field . $index] = $subitem;
        //         }
        //     } else {
        //         $bind[$field] = $item;
        //     }
        // }
        // unset($item);
        //周江寿2021年6月9日15:49:05
        $bind = [];
        foreach ($filter as $field => &$item) {
            if (in_array($field, $multiValueFields)) {
                $item = !is_array($item) && stripos($item, ',') !== false ? explode(',', $item) : $item;
                if (is_array($item)) {
                    foreach ($item as $index => $subitem) {
                        $bind[$field . $index] = $subitem;
                    }
                } else {
                    $bind[$field] = $item;
                }
            }
        }
        unset($item);
        
        
        // 2021年9月15日11:41:58周江寿  按字母ABC排序
        // if($channel['model_id'] == 7){
        //     $orderby = 'title';
        //     $orderway = 'ASC';
        // }

        //加载列表数据
        $pageList = Archives::with(['channel', 'user'])->alias('a')
            ->where('a.status', 'normal')
            ->where($condition)//新增 标题查询 start 3
            ->whereNull('a.deletetime')
            ->where(function ($query) use ($filter, $multiValueFields) {
                foreach ($filter as $field => $item) {
                    if (in_array($field, $multiValueFields)) {
                        if (is_array($item)) {
                            $query->where(function ($query) use ($field, $item, &$bind) {
                                foreach ($item as $subindex => $subitem) {
                                    $query->whereOr("FIND_IN_SET(:" . $field . $subindex . ", `{$field}`)");
                                }
                            });
                        } else {
                            $query->where("FIND_IN_SET(:{$field}, `{$field}`)");
                        }
                    } else {
                        $query->where($field, is_array($item) ? 'in' : '=', $item);
                    }
                }
            })
            ->bind($bind)
            ->join($model['table'] . ' n', 'a.id=n.id', 'LEFT')
            ->field('a.*,n.content')
            ->field('id,content', true, config('database.prefix') . $model['table'], 'n')
            ->where(function ($query) use ($channel) {
                $query->where('channel_id', 'in', \addons\cms\model\Channel::getChannelChildrenIds($channel['id']))->whereOr("FIND_IN_SET('{$channel['id']}', `channel_ids`)");
            })
            ->where('model_id', $channel->model_id)
            ->order($orderby, $orderway)
            ->paginate($channel['pagesize'], $config['pagemode'] == 'simple', ['type' => '\\addons\\cms\\library\\Bootstrap']);

        $fieldsContentList = Fields::getFieldsContentList('model', $model->id);
        foreach ($pageList as $index => $item) {
            Service::appendTextAttr($fieldsContentList, $item);
        }

        $fieldsContentList = Fields::getFieldsContentList('channel');
        Service::appendTextAttr($fieldsContentList, $channel);

        $pageList->appends(array_filter($params));
        $this->view->assign("__FILTERLIST__", $filterList);
        $this->view->assign("__ORDERLIST__", $orderList);
        $this->view->assign("__PAGELIST__", $pageList);
        $this->view->assign("__CHANNEL__", $channel);

        //设置TKD
        Config::set('cms.title', isset($channel['seotitle']) && $channel['seotitle'] ? $channel['seotitle'] : $channel['name']);
        Config::set('cms.keywords', $channel['keywords']);
        Config::set('cms.description', $channel['description']);

        //读取模板
        $template = preg_replace('/\.html$/', '', $channel["{$channel['type']}tpl"]);

        if ($this->request->isAjax()) {
            $this->success("", "", $this->view->fetch('common/' . $template . '_ajax'));
        }
        return $this->view->fetch('/' . $template);
    }
}
