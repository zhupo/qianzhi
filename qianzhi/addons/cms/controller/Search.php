<?php

namespace addons\cms\controller;

use addons\cms\library\FulltextSearch;
use addons\cms\library\Service;
use addons\cms\model\Archives;
use addons\cms\model\SearchLog;
use think\Config;
use think\Session;

/**
 * 搜索控制器
 * Class Search
 * @package addons\cms\controller
 */
class Search extends Base
{
    public function index()
    {
        $config = get_addon_config('cms');

        $search = $this->request->request("search", $this->request->request("q", ""));
        $search = mb_substr($search, 0, 100);

        //搜索入库
        $token = $this->request->request("__searchtoken__");
        if ($search && $token && $token == Session::get("__searchtoken__")) {
            $log = SearchLog::getByKeywords($search);
            if ($log) {
                $log->setInc("nums");
            } else {
                SearchLog::create(['keywords' => $search, 'nums' => 1]);
            }
        }

        if ($config['searchtype'] == 'xunsearch') {
            return $this->xunsearch();
        }

        $filterList = [];
        $orderList = [];

        $orderby = $this->request->get('orderby', '');
        $orderway = $this->request->get('orderway', '', 'strtolower');
        $params = ['q' => $search];
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

        $pageList = Archives
            ::where('status', 'normal')
            ->whereNull('deletetime')
            ->where('title', 'like', "%{$search}%")
            ->order($orderby, $orderway)
            ->paginate(10, $config['pagemode'] == 'simple', ['type' => '\\addons\\cms\\library\\Bootstrap']);

        $pageList->appends(array_filter($params));
        $this->view->assign("__FILTERLIST__", $filterList);
        $this->view->assign("__ORDERLIST__", $orderList);
        $this->view->assign("__PAGELIST__", $pageList);

        Config::set('cms.title', __("Search for %s", $search));
        return $this->view->fetch('/search');
    }

    public function typeahead()
    {
        $search = $this->request->post("search", $this->request->post("q", ""));
        $search = mb_substr($search, 0, 100);

        $list = Archives
            ::where('status', 'normal')
            ->whereNull('deletetime')
            ->where('title', 'like', "%{$search}%")
            ->order('id', 'desc')
            ->field('id,title,diyname,channel_id,likes,dislikes,tags,createtime')
            ->limit(10)
            ->select();
        $result = collection($list)->toArray();
        $result[] = ['id' => 0, 'title' => __('Search more %s', $search), 'url' => addon_url("cms/search/index", [':search' => $search, 'search' => $search])];
        return json($result);
    }

    /**
     * Xunsearch搜索
     * @return string
     * @throws \think\Exception
     */
    public function xunsearch()
    {
        $orderList = [
            'relevance'       => '默认排序',
            'createtime_desc' => '发布时间从新到旧',
            'createtime_asc'  => '发布时间从旧到新',
            'views_desc'      => '浏览次数从多到少',
            'views_asc'       => '浏览次数从少到多',
            'comments_desc'   => '评论次数从多到少',
            'comments_asc'    => '评论次数从少到多',
        ];

        $q = $this->request->request('q', $this->request->request('search', ''));
        $q = mb_substr($q, 0, 100);

        $page = $this->request->get('page/d', '1');
        $order = $this->request->get('order', '');
        $fulltext = $this->request->get('fulltext/d', '1');
        $fuzzy = $this->request->get('fuzzy/d', '0');
        $synonyms = $this->request->get('synonyms/d', '0');

        $total_begin = microtime(true);
        $search = null;
        $pagesize = 10;

        $result = FulltextSearch::search($q, $page, $pagesize, $order, $fulltext, $fuzzy, $synonyms);

        // 计算总耗时
        $total_cost = microtime(true) - $total_begin;

        //获取热门搜索
        $hot = FulltextSearch::hot();

        $data = [
            'q'           => $q,
            'error'       => '',
            'total'       => $result['total'],
            'count'       => $result['count'],
            'search_cost' => $result['microseconds'],
            'docs'        => $result['list'],
            'pager'       => $result['pager'],
            'corrected'   => $result['corrected'],
            'highlight'   => $result['highlight'],
            'related'     => $result['related'],
            'search'      => $search,
            'fulltext'    => $fulltext,
            'synonyms'    => $synonyms,
            'fuzzy'       => $fuzzy,
            'order'       => $order,
            'orderList'   => $orderList,
            'hot'         => $hot,
            'total_cost'  => $total_cost,
        ];

        Config::set('cms.title', __("Search for %s", $q));
        $this->view->assign("title", $q);
        $this->view->assign($data);
        return $this->view->fetch('/xunsearch');
    }

    public function suggestion()
    {
        $q = trim($this->request->get('q', ''));
        $q = mb_substr($q, 0, 100);

        $terms = [];
        $config = get_addon_config('cms');
        if ($config['searchtype'] == 'xunsearch') {
            $terms = FulltextSearch::suggestion($q);
        } else {
            $terms = SearchLog::where("keywords", "LIKE", "{$q}%")->where("nums", ">", 0)->column("keywords");
        }
        return json($terms);
    }
}
