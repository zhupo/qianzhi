<?php

namespace addons\cms\controller;

use addons\cms\model\Autolink;

/**
 * 跳转控制器
 * Class Go
 * @package addons\cms\controller
 */
class Go extends Base
{
    protected $noNeedLogin = ['*'];
    protected $layout = 'default';

    public function index()
    {
        $url = $this->request->get("url", "");
        $id = $this->request->get("id/d", "0");
        if ($id) {
            $autolink = Autolink::get($id);
            if ($autolink) {
                $autolink->setInc("views");
            }
        }
        //$this->redirect($url);
        return '
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="referrer" content="never">
<title></title>
</head>
<body>
<script>
    location.href="' . $url . '";
</script>
</body>
</html>';
    }

}
