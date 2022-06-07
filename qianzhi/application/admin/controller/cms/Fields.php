<?php

namespace app\admin\controller\cms;

use addons\cms\library\Service;
use app\common\controller\Backend;
use app\common\model\Config;

/**
 * 模型字段表
 *
 * @icon fa fa-circle-o
 */
class Fields extends Backend
{

    /**
     * Fields模型对象
     */
    protected $model = null;
    protected $modelValidate = true;
    protected $modelSceneValidate = true;

    protected $noNeedRight = ['rulelist'];
    protected $multiFields = 'isfilter,iscontribute';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\cms\Fields;
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign('typeList', Config::getTypeList());
        $this->view->assign('regexList', Config::getRegexList());
    }

    /**
     * 查看
     */
    public function index()
    {
        $source = $this->request->param('source', '');
        $source_id = $this->request->param('source_id', 0);

        $condition = ['source' => $source, 'source_id' => $source_id];
        $prefix = \think\Config::get('database.prefix');

        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->where($condition)
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = $this->model
                ->where($condition)
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();


            if ($source == 'model') {
                $fieldList = Service::getTableFields("{$prefix}cms_archives");
                $model = \app\admin\model\cms\Modelx::get($source_id);
                if (!$model) {
                    $this->error("模型未找到");
                }
                $setting = $model->setting;
                $list = collection($list)->toArray();

                array_unshift($fieldList, ['name' => 'content', 'title' => __('Content'), 'type' => 'text']);
                foreach ($fieldList as $field) {
                    $item = [
                        'id'           => $field['name'],
                        'state'        => false,
                        'source_id'    => $source_id,
                        'source'       => '-',
                        'name'         => $field['name'],
                        'title'        => $field['title'],
                        'type'         => $field['type'],
                        'issystem'     => true,
                        'isfilter'     => 0,
                        'iscontribute' => isset($setting['contributefields']) && is_array($setting['contributefields']) && in_array($field['name'], $setting['contributefields']) ? 1 : 0,
                        'isorder'      => isset($setting['orderfields']) && is_array($setting['orderfields']) && in_array($field['name'], $setting['orderfields']) ? 1 : 0,
                        'status'       => 'normal',
                        'createtime'   => 0,
                        'updatetime'   => 0
                    ];
                    $list[] = $item;
                }
            } elseif (in_array($source, ['channel', 'page', 'special'])) {
                $fieldList = Service::getTableFields("{$prefix}cms_" . $source);
                foreach ($fieldList as $index => $field) {
                    $item = [
                        'id'           => $field['name'],
                        'state'        => false,
                        'source_id'    => $source_id,
                        'source'       => '-',
                        'name'         => $field['name'],
                        'title'        => $field['title'],
                        'type'         => $field['type'],
                        'issystem'     => true,
                        'isfilter'     => 0,
                        'iscontribute' => 0,
                        'isorder'      => 0,
                        'status'       => 'normal',
                        'createtime'   => 0,
                        'updatetime'   => 0
                    ];
                    $list[] = $item;
                }
            } elseif ($source == 'diyform') {
                $diyform = \app\admin\model\cms\Diyform::get($source_id);
                if (!$diyform) {
                    $this->error("表单未找到");
                }
                $setting = $diyform->setting;
                $fieldList = [
                    ['name' => 'id', 'title' => 'ID', 'type' => 'int'],
                    ['name' => 'memo', 'title' => __('Memo'), 'type' => 'string'],
                    ['name' => 'createtime', 'title' => __('Createtime'), 'type' => 'int'],
                    ['name' => 'updatetime', 'title' => __('Updatetime'), 'type' => 'int'],
                    ['name' => 'status', 'title' => __('Status'), 'type' => 'enum'],
                ];
                foreach ($fieldList as $index => $field) {
                    $item = [
                        'id'           => $field['name'],
                        'state'        => false,
                        'source_id'    => $source_id,
                        'source'       => '-',
                        'name'         => $field['name'],
                        'title'        => $field['title'],
                        'type'         => $field['type'],
                        'issystem'     => true,
                        'isfilter'     => 0,
                        'iscontribute' => 0,
                        'isorder'      => isset($setting['orderfields']) && is_array($setting['orderfields']) && in_array($field['name'], $setting['orderfields']) ? 1 : 0,
                        'status'       => 'normal',
                        'createtime'   => 0,
                        'updatetime'   => 0
                    ];
                    $list[] = $item;
                }
            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        $this->assignconfig('params', "/source/{$source}/source_id/{$source_id}");
        $this->assignconfig('source', $source);
        $this->view->assign('source', $source);
        $this->view->assign('source_id', $source_id);

        if (in_array($source, ['model', 'diyform'])) {
            $model = $source == 'model' ? \app\admin\model\cms\Modelx::get($source_id) : \app\admin\model\cms\Diyform::get($source_id);
            $this->view->assign('model', $model);
            $modelList = $source == 'model' ? \app\admin\model\cms\Modelx::all() : \app\admin\model\cms\Diyform::all();
            $this->view->assign('modelList', $modelList);
        }

        return $this->view->fetch();
    }

    /**
     * 添加
     */
    public function add()
    {
        $source = $this->request->param('source', '');
        $source_id = $this->request->param('source_id', 0);
        $this->view->assign('source', $source);
        $this->view->assign('source_id', $source_id);

        $this->renderTable();
        return parent::add();
    }

    /**
     * 编辑
     */
    public function edit($ids = null)
    {
        $this->renderTable();
        return parent::edit($ids);
    }

    /**
     * 渲染表
     */
    protected function renderTable()
    {
        $tableList = [];
        $dbname = \think\Config::get('database.database');
        $list = \think\Db::query("SELECT `TABLE_NAME`,`TABLE_COMMENT` FROM `information_schema`.`TABLES` where `TABLE_SCHEMA` = '{$dbname}';");
        foreach ($list as $key => $row) {
            $tableList[$row['TABLE_NAME']] = $row['TABLE_COMMENT'];
        }
        $this->view->assign("tableList", $tableList);
    }

    /**
     * 批量操作
     * @param string $ids
     */
    public function multi($ids = "")
    {
        if (!$this->request->isPost()) {
            $this->error(__("Invalid parameters"));
        }
        $params = $this->request->request('params');
        parse_str($params, $paramsArr);
        if (isset($paramsArr['isfilter'])) {
            $field = \app\admin\model\cms\Fields::get($ids);
            if (!$field) {
                $this->error('未找到字段信息');
            }
        }
        if (isset($paramsArr['iscontribute']) && !is_numeric($ids)) {
            if (!$ids || !in_array($ids, ["channel_ids", "image", "images", "tags", "content", "keywords", "description"])) {
                $this->error('参数错误');
            }
            $source_id = $this->request->param('source_id', 0);
            $model = \app\admin\model\cms\Modelx::get($source_id);
            if (!$model) {
                $this->error("模型未找到");
            }
            $setting = $model['setting'];
            $contributefields = isset($setting['contributefields']) ? $setting['contributefields'] : [];
            if ($paramsArr['iscontribute']) {
                $contributefields[] = $ids;
            } else {
                $contributefields = array_values(array_diff($contributefields, [$ids]));
            }
            $setting['contributefields'] = $contributefields;
            $model->setting = $setting;
            $model->save();
            $this->success("");
        }
        if (isset($paramsArr['isorder']) && !is_numeric($ids)) {
            if (!$ids) {
                $this->error('参数错误');
            }
            $source = $this->request->param('source', '');
            $source_id = $this->request->param('source_id', 0);
            $model = $source == 'model' ? \app\admin\model\cms\Modelx::get($source_id) : \app\admin\model\cms\Diyform::get($source_id);
            if (!$model) {
                $this->error("模型未找到");
            }
            $setting = $model['setting'];
            $orderfields = isset($setting['orderfields']) ? $setting['orderfields'] : [];
            if ($paramsArr['isorder']) {
                $orderfields[] = $ids;
            } else {
                $orderfields = array_values(array_diff($orderfields, [$ids]));
            }
            $setting['orderfields'] = $orderfields;
            $model->setting = $setting;
            $model->save();
            $this->success("");
        }
        return parent::multi($ids);
    }

    /**
     * 规则列表
     * @internal
     */
    public function rulelist()
    {
        //主键
        $primarykey = $this->request->request("keyField");
        //主键值
        $keyValue = $this->request->request("keyValue", "");

        $keyValueArr = array_filter(explode(',', $keyValue));
        $regexList = Config::getRegexList();
        $list = [];
        foreach ($regexList as $k => $v) {
            if ($keyValueArr) {
                if (in_array($k, $keyValueArr)) {
                    $list[] = ['id' => $k, 'name' => $v];
                }
            } else {
                $list[] = ['id' => $k, 'name' => $v];
            }
        }
        return json(['list' => $list]);
    }
}
