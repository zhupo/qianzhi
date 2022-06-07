<?php

namespace addons\cms;

use addons\cms\library\FulltextSearch;
use app\common\library\Menu;
use think\Addons;
use think\Config;
use think\Db;
use think\Request;

/**
 * CMS插件
 */
class Cms extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        $menu = include ADDON_PATH . 'cms' . DS . 'data' . DS . 'menu.php';
        Menu::create($menu);

        //首次安装创建表并导入测试数据
        \think\addons\Service::importsql('cms');
        $this->importTestData();
        return true;
    }

    /**
     * 导入测试数据
     */
    protected function importTestData()
    {
        $sqlFile = ADDON_PATH . 'cms' . DS . 'testdata.sql';
        if (is_file($sqlFile)) {
            $lines = file($sqlFile);
            $templine = '';
            foreach ($lines as $line) {
                if (substr($line, 0, 2) == '--' || $line == '' || substr($line, 0, 2) == '/*') {
                    continue;
                }

                $templine .= $line;
                if (substr(trim($line), -1, 1) == ';') {
                    $templine = str_ireplace('__PREFIX__', config('database.prefix'), $templine);
                    $templine = str_ireplace('INSERT INTO ', 'INSERT IGNORE INTO ', $templine);
                    try {
                        Db::getPdo()->exec($templine);
                    } catch (\Exception $e) {
                        //$e->getMessage();
                    }
                    $templine = '';
                }
            }
        }
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        Menu::delete('cms');
        return true;
    }

    /**
     * 插件启用方法
     */
    public function enable()
    {
        Menu::enable('cms');
    }

    /**
     * 插件禁用方法
     */
    public function disable()
    {
        Menu::disable('cms');
    }

    /**
     * 插件升级方法
     */
    public function upgrade()
    {
        $menu = include ADDON_PATH . 'cms' . DS . 'data' . DS . 'menu.php';
        Menu::upgrade('cms', $menu);
    }

    /**
     * 应用初始化
     */
    public function appInit()
    {
        // 自定义路由变量规则
        \think\Route::pattern([
            'diyname' => "[a-zA-Z0-9\-_]+",
            'id'      => "\d+",
        ]);
        $config = get_addon_config('cms');
        $taglib = Config::get('template.taglib_pre_load');
        Config::set('template.taglib_pre_load', ($taglib ? $taglib . ',' : '') . 'addons\\cms\\taglib\\Cms');
        Config::set('cms', $config);
    }

    /**
     * 脚本替换
     */
    public function viewFilter(& $content)
    {
        $request = \think\Request::instance();
        $dispatch = $request->dispatch();

        if ($request->module() || !isset($dispatch['method'][0]) || $dispatch['method'][0] != '\think\addons\Route') {
            return;
        }
        $addon = isset($dispatch['var']['addon']) ? $dispatch['var']['addon'] : $request->param('addon');
        if ($addon != 'cms') {
            return;
        }
        $style = '';
        $script = '';
        $result = preg_replace_callback("/<(script|style)\s(data\-render=\"(script|style)\")([\s\S]*?)>([\s\S]*?)<\/(script|style)>/i", function ($match) use (&$style, &$script) {
            if (isset($match[1]) && in_array($match[1], ['style', 'script'])) {
                ${$match[1]} .= str_replace($match[2], '', $match[0]);
            }
            return '';
        }, $content);
        $content = preg_replace_callback('/^\s+(\{__STYLE__\}|\{__SCRIPT__\})\s+$/m', function ($matches) use ($style, $script) {
            return $matches[1] == '{__STYLE__}' ? $style : $script;
        }, $result ? $result : $content);
    }

    /**
     * 会员中心边栏后
     * @return mixed
     * @throws \Exception
     */
    public function userSidenavAfter()
    {
        $request = Request::instance();
        $controllername = strtolower($request->controller());
        $actionname = strtolower($request->action());
        $config = get_addon_config('cms');
        $sidenav = explode(',', $config['usersidenav']);
        if (!$sidenav) {
            return '';
        }
        $data = [
            'controllername' => $controllername,
            'actionname'     => $actionname,
            'sidenav'        => $sidenav
        ];

        return $this->fetch('view/hook/user_sidenav_after', $data);
    }

    public function xunsearchConfigInit()
    {
        return FulltextSearch::config();
    }

    public function xunsearchIndexReset($project)
    {
        if (!$project['isaddon'] || $project['name'] != 'cms') {
            return;
        }
        return FulltextSearch::reset();
    }

}
