<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:93:"/Users/panliu/Documents/project/zjs-copy/public/../application/admin/view/cms/parame/add.html";i:1624609452;s:83:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/layout/default.html";i:1611580232;s:80:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/meta.html";i:1611580232;s:82:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/script.html";i:1611580232;}*/ ?>
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

    <div class="form-group">
        <label for="c-type" class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-type" data-rule="required" class="form-control selectpage" data-source="cms/parame/selectpage_type" placeholder="类型为自定义,可任意输入" data-primary-key="type" data-field="type" name="row[type]" type="text" value="参数" disabled>
        </div>
    </div>
    <div class="form-group">
        <label for="c-name" class="control-label col-xs-12 col-sm-2">ID:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" data-rule="required" class="form-control <?php if($product['name'] == ""): ?>selectpage<?php endif; ?>" data-source="cms/parame/select_product" name="row[name]" value="<?php echo $product['name']; ?>" data-primary-key="id" data-field="title" placeholder="请选择需要绑定的产品" type="text" <?php if($product['name'] != ""): ?>disabled<?php endif; ?>>
            <?php if($product['name'] != ""): ?><input type="hidden" class="sp_hidden" name="row[name]" id="c-name" value="<?php echo $product['name']; ?>"><?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label for="c-title" class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio radio-inline">
                <label for="c-radio"><input class="radio-btn" id="c-text_type-1" name="row[text_type]" type="radio" value="1" checked /> <?php echo __('Content'); ?></label>
            </div>
            <div class="radio radio-inline">
                <label for="c-radio"><input class="radio-btn" id="c-text_type-2" name="row[text_type]" type="radio" value="2" /> <?php echo __('Atlas'); ?></label>
            </div>
            <div class="radio radio-inline">
                <label for="c-radio"><input class="radio-btn" id="c-text_type-3" name="row[text_type]" type="radio" value="3" /> <?php echo __('Video'); ?></label>
            </div>
            
        </div>
    </div>
    <div class="form-group" id="image-box" style="display:none">
        <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('Image'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-image" data-rule="" class="form-control" size="50" name="row[image]" type="text" value="">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-image" class="btn btn-danger plupload cropper" data-input-id="c-image" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-image"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-input-id="c-image" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-image"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-image"></ul>
        </div>
    </div>
    <div class="form-group" id="video-box" style="display:none">
        <label for="c-video" class="control-label col-xs-12 col-sm-2"><?php echo __('Video'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-video" class="form-control" name="row[video]" type="text">
        </div>
    </div>
    <div class="form-group has-success" id="atlas-box" style="display:none">
        <label for="c-imagearr" class="control-label col-xs-12 col-sm-2"><?php echo __('Atlas'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <input id="c-images" class="form-control" size="50" name="row[images]" type="text" value="" placeholder="可上传多张图片">
                                        <div class="input-group-addon no-border no-padding">
                                            <span><button type="button" id="plupload-images" class="btn btn-danger plupload" data-input-id="c-images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp,image/webp" data-multiple="true" data-preview-id="p-images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                                            <span><button type="button" id="fachoose-images" class="btn btn-primary fachoose" data-input-id="c-images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                                        </div>
                                        <span class="msg-box n-right" for="c-images"></span>
                                    </div>
                                    <!--<ul class="row list-inline plupload-preview" id="p-images"></ul>-->
                                    <ul class="row list-inline plupload-preview" id="p-images" data-template="introtpl" data-name="row[intro]"></ul>
                                    <textarea name="row[intro]" class="form-control"  style="margin-top:5px;display: none"></textarea>
                       <!--这里自定义图片预览的模板 开始-->
                                            <script type="text/html" id="introtpl">
                                                <li class="col-xs-6">
                                                    <a href="<%=fullurl%>" data-url="<%=url%>" target="_blank" class="thumbnail">
                                                        <img src="<%=fullurl%>" class="img-responsive">
                                                    </a>
                                                  
                                                                     
                                    <input type="text" name="row[intro][<%=index%>][info]" class="form-control" placeholder="请输入标题" value="<%=value?value['info']:''%>"/>
                                    
                                    <textarea class="form-control" type="text" placeholder="请输入描述" name="row[intro][<%=index%>][txt]"><%=value?value['txt']:''%></textarea>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs btn-trash"><i class="fa fa-trash"></i></a>
                                                </li>
                                            </script>
                        <!--这里自定义图片预览的模板 结束-->
                                </div>
                            
    </div>
    
   <div  id="content-box">
       <div class="form-group">
        <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('File'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-file" class="form-control" name="row[file]" type="text" value="" data-rule="" data-tip="">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-file" class="btn btn-danger plupload" data-input-id="c-file" data-multiple="false" ><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-file" class="btn btn-primary fachoose" data-input-id="c-file" data-multiple="false" ><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-file"></span>
            </div>
        </div>
    </div> 
    <div class="form-group">
        <label for="c-content" class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-content" data-rule="" class="form-control editor" rows="25" name="row[content]" cols="50"></textarea>
        </div>
    </div>

    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <div class="radio">
                <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
                <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"normal"))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
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
