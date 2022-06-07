<?php

namespace addons\cms\controller;

use addons\cms\library\Service;
use addons\cms\model\Fields;
use addons\cms\model\Special as SpecialModel;
use addons\cms\model\Tag;
use addons\cms\model\Taggable;
use think\Config;
use think\Exception;

/**
 * 专题控制器
 * Class Special
 * @package addons\cms\controller
 */
class Special extends Base
{
    /**
     * 专题页面
     * @return string
     * @throws Exception
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $config = get_addon_config('cms');

        $diyname = $this->request->param('diyname');
        if ($diyname && !is_numeric($diyname)) {
            $special = SpecialModel::getByDiyname($diyname);
        } else {
            $id = $diyname ? $diyname : $this->request->param('id', '');
            $special = SpecialModel::get($id);
        }
        if (!$special || $special['status'] == 'hidden') {
            $this->error(__('No specified special found'));
        }
        $special->setInc("views", 1);

        $fieldsContentList = Fields::getFieldsContentList('special');
        Service::appendTextAttr($fieldsContentList, $special);

        $archivesList = \addons\cms\model\Archives::with(['channel'])
            ->where(function ($query) use ($special) {
                $query->whereRaw("FIND_IN_SET('{$special->id}', `special_ids`)");
                if ($special['tag_ids']) {
                    $query->whereOr('id', 'in', function ($query) use ($special) {
                        return $query->name("cms_taggable")->where("tag_id", 'in', $special['tag_ids'])->field("archives_id");
                    });
                }
            })
            ->where('status', 'normal')
            ->whereNull('deletetime')
            ->order('weigh DESC,id DESC')
            ->paginate(10, $config['pagemode'] == 'simple', ['type' => '\\addons\\cms\\library\\Bootstrap']);

        $this->view->assign("archivesList", $archivesList);
        $this->view->assign("__PAGELIST__", $archivesList);
        $this->view->assign("__SPECIAL__", $special);

        //设置TKD
        Config::set('cms.title', isset($special['seotitle']) && $special['seotitle'] ? $special['seotitle'] : $special['title']);
        Config::set('cms.keywords', $special['keywords']);
        Config::set('cms.description', $special['description']);

        $special['template'] = $special['template'] ? $special['template'] : 'special.html';
        $template = preg_replace('/\.html$/', '', $special['template']);

        if ($this->request->isAjax()) {
            $this->success("", "", $this->view->fetch('common/special_list'));
        }
        return $this->view->fetch('/' . $template);
    }

}
