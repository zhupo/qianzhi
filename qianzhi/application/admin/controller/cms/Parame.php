<?php

namespace app\admin\controller\cms;

use app\common\controller\Backend;
use think\Db;

/**
 * 区块表
 *
 * @icon fa fa-th-large
 */
class Parame extends Backend
{

    /**
     * Parame模型对象
     */
    protected $model = null;
    protected $noNeedRight = ['selectpage_type'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\cms\Parame;
        $this->view->assign("statusList", $this->model->getStatusList());
        if(!empty($_GET['name'])){
            $_POST['name'] = $_GET['name'];
            $product['name'] = $_GET['name'];
            $this->view->assign("product", $product);
        }else{
            $product['name'] = '';
            $this->view->assign("product", $product);
        }
        
    }

    public function index()
    {
        $typeArr = \app\admin\model\cms\Parame::distinct('type')->column('type');

        $this->view->assign('typeList', $typeArr);
        $this->assignconfig('typeList', $typeArr);
        return parent::index();
    }

    public function selectpage_type()
    {
        $list = [];
        $word = (array)$this->request->request("q_word/a");
        $field = $this->request->request('showField');
        $keyValue = $this->request->request('keyValue');
        if (!$keyValue) {
            if (array_filter($word)) {
                foreach ($word as $k => $v) {
                    $list[] = ['id' => $v, $field => $v];
                }
            }
            $typeArr = \app\admin\model\cms\Parame::column('type');
            $typeArr = array_unique($typeArr);
            foreach ($typeArr as $index => $item) {
                $list[] = ['id' => $item, $field => $item];
            }
        } else {
            $list[] = ['id' => $keyValue, $field => $keyValue];
        }

        return json(['total' => count($list), 'list' => $list]);
    }
    
    //获取产品列表
    public function select_product()
    {
        $where['model_id'] = 2;
        $where['deletetime'] = null;
        $list = Db::table('fa_cms_archives')->where($where)->field('id,title')->select();
        
        return json(['total' => count($list), 'list' => $list]);
    }

    public function import()
    {
        return parent::import();
    }
}
