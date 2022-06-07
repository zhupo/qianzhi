<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:94:"/Users/panliu/Documents/project/zjs-copy/public/../application/admin/view/cms/fields/edit.html";i:1611729154;s:83:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/layout/default.html";i:1611580232;s:80:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/meta.html";i:1611580232;s:82:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/script.html";i:1611580232;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="referrer" content="never">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<?php if(\think\Config::get('fastadmin.adminskin')): ?>
<link href="/assets/css/skins/<?php echo \think\Config::get('fastadmin.adminskin'); ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<?php endif; ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>

    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav') && \think\Config::get('fastadmin.breadcrumb')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <?php if($auth->check('dashboard')): ?>
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                    <?php endif; ?>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
    <input type="hidden" name="row[source]" value="<?php echo $row['source']; ?>"/>
    <input type="hidden" name="row[source_id]" value="<?php echo $row['source_id']; ?>"/>
    <input type="hidden" name="row[oldname]" value="<?php echo $row['name']; ?>"/>
    <div class="form-group">
        <label for="c-name" class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-name" data-rule="required" class="form-control" name="row[name]" type="text" value="<?php echo $row['name']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-title" class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="<?php echo $row['title']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-type" class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <select name="row[type]" id="c-type" class="form-control selectpicker">
                <?php if(is_array($typeList) || $typeList instanceof \think\Collection || $typeList instanceof \think\Paginator): $i = 0; $__LIST__ = $typeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $key; ?>" <?php if($row['type']==$key): ?>selected<?php endif; ?>><?php echo $type; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group hidden tf tf-number">
        <label for="c-decimals" class="control-label col-xs-12 col-sm-2"><?php echo __('Decimals'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-decimals" class="form-control" name="row[decimals]" type="number" value="<?php echo $row['decimals']; ?>">
        </div>
    </div>
    <div class="form-group hidden tf tf-checkbox">
        <label for="c-minimum" class="control-label col-xs-12 col-sm-2"><?php echo __('Minimum'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-minimum" class="form-control" name="row[minimum]" type="number" value="<?php echo $row['minimum']; ?>">
        </div>
    </div>
    <div class="form-group hidden tf tf-selects tf-images tf-files tf-checkbox">
        <label for="c-maximum" class="control-label col-xs-12 col-sm-2"><?php echo __('Maximum'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-maximum" class="form-control" name="row[maximum]" type="number" value="<?php echo $row['maximum']; ?>">
        </div>
    </div>
    <div class="form-group hidden tf tf-selectpage tf-selectpages">
        <label for="c-selectpage-table" class="control-label col-xs-12 col-sm-2"><?php echo __('Selectpage table'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <select id="c-selectpage-table" name="row[setting][table]" class="form-control selectpicker" data-live-search="true">
                <option value=""><?php echo __('Please select table'); ?></option>
                <?php if(is_array($tableList) || $tableList instanceof \think\Collection || $tableList instanceof \think\Paginator): if( count($tableList)==0 ) : echo "" ;else: foreach($tableList as $key=>$item): ?>
                <option value="<?php echo $key; ?>" data-subtext="<?php echo $item; ?>" <?php if($row['setting']['table']==$key): ?>selected<?php endif; ?>><?php echo $key; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group hidden tf tf-selectpage tf-selectpages">
        <label for="c-selectpage-primarykey" class="control-label col-xs-12 col-sm-2"><?php echo __('Selectpage primarykey'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <select name="row[setting][primarykey]" class="form-control selectpicker" id="c-selectpage-primarykey" data-value="<?php echo (isset($row['setting']['primarykey']) && ($row['setting']['primarykey'] !== '')?$row['setting']['primarykey']:''); ?>"></select>
        </div>
    </div>
    <div class="form-group hidden tf tf-selectpage tf-selectpages">
        <label for="c-selectpage-field" class="control-label col-xs-12 col-sm-2"><?php echo __('Selectpage field'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <select name="row[setting][field]" class="form-control selectpicker" id="c-selectpage-field" data-value="<?php echo (isset($row['setting']['field']) && ($row['setting']['field'] !== '')?$row['setting']['field']:''); ?>"></select>
        </div>
    </div>
    <div class="form-group hidden tf tf-selectpage tf-selectpages">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Selectpage conditions'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <dl class="fieldlist" data-name="row[setting][conditions]">
                <dd>
                    <ins><?php echo __('Field title'); ?></ins>
                    <ins><?php echo __('Field value'); ?></ins>
                </dd>

                <dd><a href="javascript:;" class="append btn btn-sm btn-success"><i class="fa fa-plus"></i> <?php echo __('Append'); ?></a></dd>
                <textarea name="row[setting][conditions]" class="form-control hide" cols="30" rows="5"><?php echo (isset($row['setting']['conditions']) && ($row['setting']['conditions'] !== '')?$row['setting']['conditions']:''); ?></textarea>
            </dl>
        </div>
    </div>
    <div class="form-group hidden tf tf-array">
        <label for="c-array-key" class="control-label col-xs-12 col-sm-2"><?php echo __('Array key'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input type="text" name="row[setting][key]" class="form-control" id="c-array-key" value="<?php echo (isset($row['setting']['key']) && ($row['setting']['key'] !== '')?$row['setting']['key']:''); ?>">
        </div>
    </div>
    <div class="form-group hidden tf tf-array">
        <label for="c-array-value" class="control-label col-xs-12 col-sm-2"><?php echo __('Array value'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input type="text" name="row[setting][value]" class="form-control" id="c-array-value" value="<?php echo (isset($row['setting']['value']) && ($row['setting']['value'] !== '')?$row['setting']['value']:''); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-content" class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:<br><span class="text-muted"><a href="javascript:" data-toggle="tooltip" data-title="筛选列表将用于前台列表筛选使用"><?php echo __('Filter List'); ?> <i class="fa fa-info-circle"></i></a></span></label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-content" data-rule="required" class="form-control" name="row[content]"><?php echo htmlentities($row['content']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-defaultvalue" class="control-label col-xs-12 col-sm-2"><?php echo __('Defaultvalue'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-defaultvalue" class="form-control" name="row[defaultvalue]" type="text" value="<?php echo htmlentities($row['defaultvalue']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-rule" class="control-label col-xs-12 col-sm-2"><?php echo __('Rule'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-rule" class="form-control selectpage" data-source="cms/fields/rulelist" data-multiple="true" name="row[rule]" type="text" value="<?php echo $row['rule']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-msg" class="control-label col-xs-12 col-sm-2"><?php echo __('Validate Msg'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-msg" class="form-control" name="row[msg]" type="text" value="<?php echo htmlentities($row['msg']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-ok" class="control-label col-xs-12 col-sm-2"><?php echo __('Validate Ok'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-ok" class="form-control" name="row[ok]" type="text" value="<?php echo htmlentities($row['ok']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-tip" class="control-label col-xs-12 col-sm-2"><?php echo __('Validate Tip'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-tip" class="form-control" name="row[tip]" type="text" value="<?php echo htmlentities($row['tip']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-length" class="control-label col-xs-12 col-sm-2"><?php echo __('Length'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-length" data-rule="required" class="form-control" name="row[length]" type="number" value="<?php echo $row['length']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Isfilter'); ?>:</label>

        <div class="col-xs-12 col-sm-8">
            <input id="c-isfilter" name="row[isfilter]" type="hidden" value="<?php echo $row['isfilter']; ?>">
            <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-isfilter" data-yes="1" data-no="0">
                <i class="fa fa-toggle-on text-success <?php if($row['isfilter'] == '0'): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
            </a>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Iscontribute'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-iscontribute" name="row[iscontribute]" type="hidden" value="<?php echo $row['iscontribute']; ?>">
            <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-iscontribute" data-yes="1" data-no="0">
                <i class="fa fa-toggle-on text-success <?php if($row['iscontribute'] == '0'): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
            </a>
        </div>
    </div>
    <div class="form-group">
        <label for="c-extend" class="control-label col-xs-12 col-sm-2"><?php echo __('Extend'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-extend" class="form-control" name="row[extend]" placeholder="<?php echo __('Extend tips'); ?>" data-tip="<?php echo __('Extend tips'); ?>"><?php echo htmlentities($row['extend']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-weigh" class="control-label col-xs-12 col-sm-2"><?php echo __('Weigh'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-weigh" data-rule="required" class="form-control" name="row[weigh]" type="number" value="<?php echo $row['weigh']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <div class="radio">
                <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
                <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['status'])?$row['status']:explode(',',$row['status']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>
