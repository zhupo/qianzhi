<?php

namespace addons\cms\controller;

use think\Request;

/**
 * CMS控制器基类
 */
class Base extends \think\addons\Controller
{

    // 初始化
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $config = get_addon_config('cms');
        // 设定主题模板目录
        $this->view->engine->config('view_path', $this->view->engine->config('view_path') . $config['theme'] . DS);
        // 加载自定义标签库
        //$this->view->engine->config('taglib_pre_load', 'addons\cms\taglib\Cms');
        // 默认渲染栏目为空
        $this->view->assign('__CHANNEL__', null);
        // 定义CMS首页的URL
        \think\Config::set('cms.indexurl', addon_url('cms/index/index', [], false));
    }

    public function _initialize()
    {
        parent::_initialize();
        // 如果请求参数action的值为一个方法名,则直接调用
        $action = $this->request->post("action");
        if ($action && $this->request->isPost()) {
            return $this->$action();
        }
    }
}
