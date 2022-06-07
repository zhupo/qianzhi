<?php

namespace addons\cms\controller;

use addons\cms\library\Service;
use addons\cms\model\Archives as ArchivesModel;
use addons\cms\model\Channel;
use addons\cms\model\Fields;
use addons\cms\model\Modelx;
use think\Config;
use think\Exception;

/**
 * 文档控制器
 * Class Archives
 * @package addons\cms\controller
 */
class Archives extends Base
{
    public function index()
    {
        $action = $this->request->post("action");
        if ($action && $this->request->isPost()) {
            return $this->$action();
        }
        $diyname = $this->request->param('diyname');
        if ($diyname && !is_numeric($diyname)) {
            $archives = ArchivesModel::getByDiyname($diyname);
        } else {
            $id = $diyname ? $diyname : $this->request->param('id', '');
            $archives = ArchivesModel::get($id, ['channel']);
        }
         if(!empty($archives['intro'])){
            $intro= str_replace(array("[","]",'"'),'',$archives['intro']);
           $archives['intro'] = explode(',',$intro);
            
            //新增 
        }
         
        if (!$archives || ($archives['user_id'] != $this->auth->id && $archives['status'] != 'normal') || $archives['deletetime']) {
            $this->error(__('No specified article found'));
        }
        if (!$this->auth->id && !$archives['isguest']) {
            $this->error(__('Please login first'), 'index/user/login');
        }
        $channel = Channel::get($archives['channel_id']);
        if (!$channel) {
            $this->error(__('No specified channel found'));
        }
        $model = Modelx::get($channel['model_id'], [], true);
        if (!$model) {
            $this->error(__('No specified model found'));
        }
        $addon = db($model['table'])->where('id', $archives['id'])->find();
        if ($addon) {
            if ($model->fields) {
                $fieldsContentList = Fields::getFieldsContentList('model', $model->id);
                Service::appendTextAttr($fieldsContentList, $addon);

            }
            $archives->setData($addon);
        } else {
            $this->error(__('No specified addon article found'));
        }

        //PC支持内容分页
        $page = (int)$this->request->request("page", 1);
        $page = max(1, $page);
        $contentArr = array_filter(explode("##pagebreak##", $archives->content));
        $content = $contentArr ? (isset($contentArr[$page - 1]) ? $contentArr[$page - 1] : $contentArr[0]) : '';
        $archives->content = $content . $archives->getPagerHTML($page, count($contentArr));
         
        $archives->setInc("views", 1);
        $this->view->assign("__ARCHIVES__", $archives);
        $this->view->assign("title", $archives['id']);
        $this->view->assign("__CHANNEL__", $channel);
        $this->view->assign("__MODEL__", $model);

        //设置TKD
        Config::set('cms.title', isset($archives['seotitle']) && $archives['seotitle'] ? $archives['seotitle'] : $archives['title']);
        Config::set('cms.keywords', $archives['keywords']);
        Config::set('cms.description', $archives['description']);

        //是否跳转链接
        if (isset($archives['outlink']) && $archives['outlink']) {
            $regex = "/^((?:[a-z]+:)?\/\/)(.*)/i";
            if (preg_match($regex, $archives['outlink'])) {
                return $this->view->fetch("/outlink", ['remainseconds' => 10]);
            } else {
                $this->redirect($archives['outlink']);
            }
        }

        $template = preg_replace('/\.html$/', '', $channel['showtpl']);
        return $this->view->fetch('/' . $template);
    }

    /**
     * 赞与踩
     */
    public function vote()
    {
        $id = (int)$this->request->post("id");
        $type = trim($this->request->post("type", ""));
        if (!$id || !$type) {
            $this->error(__('Operation failed'));
        }
        $archives = ArchivesModel::get($id);
        if (!$archives || ($archives['user_id'] != $this->auth->id && $archives['status'] != 'normal') || $archives['deletetime']) {
            $this->error(__('No specified article found'));
        }
        $archives->where('id', $id)->setInc($type === 'like' ? 'likes' : 'dislikes', 1);
        $archives = ArchivesModel::get($id);
        $this->success(__('Operation completed'), null, ['likes' => $archives->likes, 'dislikes' => $archives->dislikes, 'likeratio' => $archives->likeratio]);
    }

    /**
     * 下载次数
     */
    public function download()
    {
        $id = (int)$this->request->post("id");
        if (!$id) {
            $this->error(__('Operation failed'));
        }
        $archives = ArchivesModel::get($id, ['model']);
        if (!$archives || ($archives['user_id'] != $this->auth->id && $archives['status'] != 'normal') || $archives['deletetime']) {
            $this->error(__('No specified article found'));
        }
        try {
            $table = $archives->getRelation('model')->getData('table');
            \think\Db::name($table)->where('id', $id)->setInc('downloads');
        } catch (Exception $e) {
            //
        }
        $this->success(__('Operation completed'), null);
    }
}
