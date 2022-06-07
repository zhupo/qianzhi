<?php

namespace addons\cms\controller;

use think\Config;

/**
 * Sitemap控制器
 * Class Sitemap
 * @package addons\cms\controller
 */
class Sitemap extends Base
{
    protected $noNeedLogin = ['*'];
    protected $options = [
        'item_key'  => '',
        'root_node' => 'urlset',
        'item_node' => 'url',
        'root_attr' => 'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:mobile="http://www.baidu.com/schemas/sitemap-mobile/1/"'
    ];

    public function _initialize()
    {
        parent::_initialize();
        Config::set('default_return_type', 'xml');
    }

    /**
     * Sitemap集合
     */
    public function index()
    {
        $pagesize = $this->request->param('pagesize/d', 50000);
        $type = $this->request->param('type', '');
        $type = str_replace('.xml', '', $type);
        $list = [];
        if (!$type || $type == 'archives') {
            $archivesList = \addons\cms\model\Archives::where('status', 'normal')->field('id,channel_id,diyname,createtime')->paginate($pagesize, false, ['path' => '/addons/cms/sitemap/archives/page/[PAGE]']);
            $lastPage = $archivesList->lastPage();
            foreach ($archivesList->getUrlRange(1, $lastPage) as $index => $item) {
                $list[] = ['loc' => url($item, '', 'xml', true)];
            }
        }
        if (!$type || $type == 'tags') {
            $tagsList = \addons\cms\model\Tag::where('status', 'normal')->field('id,name')->paginate($pagesize, false, ['path' => '/addons/cms/sitemap/tags/page/[PAGE]']);
            $lastPage = $tagsList->lastPage();
            foreach ($tagsList->getUrlRange(1, $lastPage) as $index => $item) {
                $list[] = ['loc' => url($item, '', 'xml', true)];
            }
        }
        $this->options = [
            'item_key'  => '',
            'root_node' => 'sitemapindex',
            'item_node' => 'sitemap',
            'root_attr' => ''
        ];
        return xml($list, 200, [], $this->options);
    }

    /**
     * 文章
     */
    public function archives()
    {
        $pagesize = $this->request->param('pagesize/d', 50000);
        $archivesList = \addons\cms\model\Archives::where('status', 'normal')->cache(3600)->field('id,channel_id,diyname,createtime')->paginate($pagesize);
        $list = [];
        foreach ($archivesList as $index => $item) {
            $list[] = [
                'loc'      => $item->fullurl,
                'priority' => 0.8
            ];
        }
        return xml($list, 200, [], $this->options);
    }

    /**
     * 标签
     */
    public function tags()
    {
        $pagesize = $this->request->param('pagesize/d', 50000);
        $tagsList = \addons\cms\model\Tag::where('status', 'normal')->cache(3600)->field('id,name')->paginate($pagesize);
        $list = [];
        foreach ($tagsList as $index => $item) {
            $list[] = [
                'loc'      => $item->fullurl,
                'priority' => 0.6
            ];
        }
        return xml($list, 200, [], $this->options);
    }
}
