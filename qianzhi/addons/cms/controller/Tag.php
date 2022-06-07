<?php

namespace addons\cms\controller;

use addons\cms\library\Service;
use addons\cms\model\Archives;
use addons\cms\model\Tag as TagModel;
use addons\cms\model\Taggable;
use think\Config;

/**
 * 标签控制器
 * Class Tag
 * @package addons\cms\controller
 */
class Tag extends Base
{
    public function index()
    {
        $config = get_addon_config('cms');

        $tag = null;
        $name = $this->request->param('name');
        if ($name && !is_numeric($name)) {
            $tag = TagModel::getByName($name);
        } else {
            $id = $name ? $name : $this->request->param('id', '');
            $tag = TagModel::get($id);
        }
        if (!$tag) {
            $this->error(__('No specified tags found'));
        }

        $filterList = [];
        $orderList = [];

        $orderby = $this->request->get('orderby', '');
        $orderway = $this->request->get('orderway', '', 'strtolower');
        $params = [];
        if ($orderby) {
            $params['orderby'] = $orderby;
        }
        if ($orderway) {
            $params['orderway'] = $orderway;
        }

        //默认排序字段
        $orders = [
            ['name' => 'default', 'field' => 'weigh', 'title' => __('Default')],
            ['name' => 'views', 'field' => 'views', 'title' => __('Views')],
            ['name' => 'id', 'field' => 'id', 'title' => __('Post date')],
        ];

        //获取排序列表
        list($orderList, $orderby, $orderway) = Service::getOrderList($orderby, $orderway, $orders, $params);

        $pageList = Archives::with(['channel'])
            ->where('status', 'normal')
            ->where('id', 'in', function ($query) use ($tag) {
                return $query->name('cms_taggable')->where('tag_id', $tag['id'])->field('archives_id');
            })
            ->order($orderby, $orderway)
            ->paginate(10, $config['pagemode'] == 'simple', ['type' => '\\addons\\cms\\library\\Bootstrap']);

        $pageList->appends(array_filter($params));
        $this->view->assign("__FILTERLIST__", $filterList);
        $this->view->assign("__ORDERLIST__", $orderList);
        $this->view->assign("__TAG__", $tag);
        $this->view->assign("__TAGS__", $tag);
        $this->view->assign("__PAGELIST__", $pageList);

        //设置TKD
        Config::set('cms.title', isset($tag['seotitle']) && $tag['seotitle'] ? $tag['seotitle'] : $tag['name']);
        Config::set('cms.keywords', $tag['keywords']);
        Config::set('cms.description', $tag['description']);
        return $this->view->fetch('/tag');
    }
}
