<?php

namespace addons\cms\controller;

use think\Config;

/**
 * CMS首页控制器
 * Class Index
 * @package addons\cms\controller
 */
class Index extends Base
{
    public function index()
    {
        //$arr = [];
        //$content = file_get_contents(ADDON_PATH . 'cms/testdata.sql');
        //$content = preg_replace_callback("/https:\/\/cdn\.(demo\.)?fastadmin\.net\/uploads\/([0-9]+)\/([\w]+)\.(png|jpg)/i", function ($matches) use (&$arr) {
        //    if (!$arr) {
        //        $arr = [
        //            368,
        //            866,
        //            450,
        //            320,
        //            197,
        //            1005,
        //            251,
        //            167,
        //            287,
        //            265
        //        ];
        //    }
        //    $key = array_rand($arr, 1);
        //    $id = $arr[$key];
        //    unset($arr[$key]);
        //
        //    $url = "https://picsum.photos/id/{$id}/800/600";
        //    return $url;
        //}, $content);
        //echo $content;exit;
        $config = get_addon_config('cms');

        //设置TKD
        Config::set('cms.title', $config['title'] ?: __('Home'));
        Config::set('cms.keywords', $config['keywords']);
        Config::set('cms.description', $config['description']);

        if ($this->request->isAjax()) {
            $this->success("", "", $this->view->fetch('common/index_list'));
        }
        return $this->view->fetch('/index');
    }

}
