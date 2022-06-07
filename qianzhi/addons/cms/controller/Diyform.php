<?php

namespace addons\cms\controller;

use addons\cms\library\Service;
use addons\cms\model\Diydata;
use addons\cms\model\Diyform as DiyformModel;
use addons\cms\model\Fields;
use think\Config;
use think\Exception;
use think\Hook;

/**
 * 自定义表单控制器
 * Class Diyform
 * @package addons\cms\controller
 */
class Diyform extends Base
{

    protected $diyform = null;

    public function _initialize()
    {
        parent::_initialize();

        $diyname = $this->request->param('diyname');
        if ($diyname && !is_numeric($diyname)) {
            $diyform = DiyformModel::getByDiyname($diyname);
        } else {
            $id = $diyname ? $diyname : $this->request->get('id', '');
            $diyform = DiyformModel::get($id);
        }
        if (!$diyform || $diyform['status'] != 'normal') {
            $this->error(__('表单未找到'));
        }
        if ($diyform['needlogin'] && !$this->auth->id) {
            $this->error(__('请登录后再操作'), "index/user/login");
        }
        $this->diyform = $diyform;
        $this->view->assign("__DIYFORM__", $diyform);
    }

    /**
     * 数据列表
     * @return string
     */
    public function index()
    {
        $diyform = $this->diyform;

        $config = get_addon_config('cms');

        $filter = $this->request->get('filter/a', []);
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
            $params['filter'] = $filter;
        }
        if ($orderby) {
            $params['orderby'] = $orderby;
        }
        if ($orderway) {
            $params['orderway'] = $orderway;
        }
        if ($multiple) {
            $params['multiple'] = $multiple;
        }

        //默认排序字段
        $orders = [
            ['name' => 'default', 'field' => 'createtime DESC,id DESC', 'title' => __('Default')],
        ];

        //合并特殊筛选字段
        $orders = array_merge($orders, $diyform->getOrderFields());

        //获取过滤列表
        list($filterList, $filter, $params, $fields, $multiValueFields, $fieldsList) = Service::getFilterList('diyform', $diyform['id'], $filter, $params, $multiple);

        //获取排序列表
        list($orderList, $orderby, $orderway) = Service::getOrderList($orderby, $orderway, $orders, $params, $fieldsList);

        $auth = $this->auth;
        $model = new Diydata([], $diyform);
        $pageList = $model
            ->where(function ($query) use ($filter, $multiValueFields) {
                foreach ($filter as $index => $item) {
                    if (in_array($index, $multiValueFields)) {
                        $query->where("FIND_IN_SET(:{$index}, `{$index}`)");
                    } else {
                        $query->where($index, $item);
                    }
                }
            })
            ->bind($multiValueFields ? array_intersect_key($filter, array_flip($multiValueFields)) : [])
            ->where(function ($query) use ($diyform, $auth) {
                //用户过滤模式
                //如果是仅用户自己消息可见
                if ($diyform['usermode'] == 'user') {
                    $query->where('user_id', $auth->id);
                }
            })
            ->where(function ($query) use ($diyform, $auth) {
                //状态过滤模式
                if ($diyform['statusmode'] === 'normal') {
                    if ($auth->id) {
                        $query->whereRaw("user_id='" . intval($auth->id) . "' OR status='normal'");
                    } else {
                        $query->where('status', 'normal');
                    }
                }
            })
            ->order($orderby, $orderway)
            ->paginate(10, $config['pagemode'] == 'simple', ['type' => '\\addons\\cms\\library\\Bootstrap']);

        $this->view->assign("__FILTERLIST__", $filterList);
        $this->view->assign("__ORDERLIST__", $orderList);
        $this->view->assign("__PAGELIST__", $pageList);

        //设置TKD
        Config::set('cms.title', $diyform['seotitle'] ?: $diyform['title']);
        Config::set('cms.keywords', $diyform['keywords']);
        Config::set('cms.description', $diyform['description']);

        //读取模板
        $template = preg_replace("/\.html$/i", "", $diyform['listtpl'] ? $diyform['listtpl'] : 'diyform_list');
        $template = $this->request->get("noframe", "0") ? "diyform_noframe" : $template;
        return $this->view->fetch('/' . $template);
    }

    /**
     * 查看详情
     * @return string
     */
    public function show()
    {
        $diyform = $this->diyform;

        $id = $this->request->param('id/d');
        $auth = $this->auth;
        $model = new Diydata([], $diyform);

        $diydata = $model
            ->where('id', $id)
            ->where(function ($query) use ($diyform, $auth) {
                //用户过滤模式
                //如果是仅用户自己消息可见
                if ($diyform['usermode'] == 'user') {
                    $query->where('user_id', $auth->id);
                }
            })
            ->where(function ($query) use ($diyform, $auth) {
                //状态过滤模式
                if ($diyform['statusmode'] === 'normal') {
                    if ($auth->id) {
                        $query->whereRaw("user_id='" . intval($auth->id) . "' OR status='normal'");
                    } else {
                        $query->where('status', 'normal');
                    }
                }
            })
            ->find();

        if (!$diydata) {
            $this->error("数据未找到或正在审核");
        }
        $fieldsList = Fields::where('source', 'diyform')->where('source_id', $diyform['id'])
            ->order('weigh desc,id desc')->column("*", "name");
        $this->view->assign('fieldsList', $fieldsList);
        $this->view->assign("__DIYDATA__", $diydata);

        //设置TKD
        Config::set('cms.title', $diyform['name'] . '详情');
        Config::set('cms.keywords', '');
        Config::set('cms.description', '');
        //加载模板
        $template = preg_replace("/\.html$/i", "", $diyform['showtpl'] ? $diyform['showtpl'] : 'diyform_show');
        return $this->view->fetch('/' . $template);
    }

    /**
     * 自定义表单提交
     */
    public function post()
    {
        $diyform = $this->diyform;
        $id = $this->request->request("id/d");
        $diydata = new Diydata([], $diyform);
        if ($id) {
            if (!$this->auth->isLogin()) {
                $this->error("请登录后再操作");
            }
            $diydata = $diydata->find($id);
            if (!$diydata) {
                $this->error("未找到指定数据");
            }
            if ($diydata['user_id'] != $this->auth->id) {
                $this->error("无法进行越权操作");
            }
        }
        if ($this->request->isPost()) {
            $config = get_addon_config('cms');
            $this->token();
            $row = $this->request->post('row/a');
            unset($row['id']);

            $fields = DiyformModel::getDiyformFields($diyform['id']);
            foreach ($fields as $index => $field) {
                if ($field['isrequire'] && (!isset($row[$field['name']]) || $row[$field['name']] == '')) {
                    $this->error("{$field['title']}不能为空！");
                }
            }

            $row['user_id'] = $this->auth->id;
            foreach ($row as $index => &$value) {
                if (is_array($value) && isset($value['field'])) {
                    $value = json_encode(\app\common\model\Config::getArrayData($value), JSON_UNESCAPED_UNICODE);
                } else {
                    $value = is_array($value) ? implode(',', $value) : $value;
                }
            }
            $diydata['status'] = 'hidden';
            try {
                $diydata->save($row);
                //周江寿2021年4月20日10:40:50新增开始
                $config = \think\Config::get('site');
                if($config['autosend'] == 1){
                    $content = 'Name：'.$row['name'].'<br> Email：'.$row['email'].'<br> message：'.$row['content'];
                    $email = new \app\common\library\Email;
                    $result = $email
                        ->to($config['email'])//接收邮箱
                        ->subject("您的网站有新的留言消息，请注意查收！")
                        ->message($content)
                        ->send();
                }
                
                //新增结束
            } catch (\Exception $e) {
                $this->error("发生错误:" . $e->getMessage());
            }
            //发送通知
            //Service::notice('CMS收到新的' . $diyform['name'], $config['auditnotice'], $config['noticetemplateid']);

            $this->success($diyform['successtips'] ? $diyform['successtips'] : '提交成功！', $diyform['redirecturl'] ? url($diyform['redirecturl']) : $diyform['url']);
        }

        $fields = DiyformModel::getDiyformFields($diyform['id'], $diydata->toArray());
        $data = [
            'fields' => $fields
        ];
        $diyform['fieldslist'] = $this->fetch('common/fields', $data);

        // 语言检测
        $lang = strip_tags($this->request->langset());
        $site = Config::get("site");
        $upload = \app\common\model\Config::upload();
        // 上传信息配置后
        Hook::listen("upload_config_init", $upload);

        // 配置信息
        $config = [
            'site'           => array_intersect_key($site, array_flip(['name', 'cdnurl', 'version', 'timezone', 'languages'])),
            'upload'         => $upload,
            'modulename'     => 'addons',
            'controllername' => 'diyform',
            'actionname'     => 'index',
            'jsname'         => 'diyform/index',
            'moduleurl'      => rtrim(url("/index", '', false), '/'),
            'language'       => $lang
        ];
        $config = array_merge($config, Config::get("view_replace_str"));

        Config::set('upload', array_merge(Config::get('upload'), $upload));
        // 配置信息后
        Hook::listen("config_init", $config);

        $this->view->assign('diydata', $diydata);
        $this->view->assign('__DIYDATA__', $diydata);
        $this->view->assign('jsconfig', $config);

        //设置TKD
        Config::set('cms.title', ($id ? "修改" : "发布") . $diyform['name']);
        Config::set('cms.keywords', '');
        Config::set('cms.description', '');

        $template = preg_replace("/\.html$/i", "", $diyform['posttpl'] ? $diyform['posttpl'] : 'diyform_post');
        $template = $this->request->get("noframe", "0") ? "diyform_noframe" : $template;
        return $this->view->fetch('/' . $template);
    }
}
