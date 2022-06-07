<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:92:"/Users/panliu/Documents/project/zjs-copy/public/../application/admin/view/cms/page/edit.html";i:1618816601;s:83:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/layout/default.html";i:1611580232;s:80:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/meta.html";i:1611580232;s:86:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/cms/common/fields.html";i:1649302861;s:82:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/script.html";i:1611580232;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
    <?php echo token(); ?>
    <input type="hidden" id="page-id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
        <label for="c-type" class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-type" data-rule="required" class="form-control selectpage" data-source="cms/page/selectpage_type" placeholder="类型为自定义,可任意输入,无需确认,自动添加" data-primary-key="type" data-field="type" name="row[type]" type="text" value="<?php echo $row['type']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-title" class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-title" data-rule="required" class="form-control" name="row[title]" type="text" value="<?php echo htmlentities($row['title']); ?>">
        </div>
    </div>
    <div class="form-group hide">
        <label for="c-flag" class="control-label col-xs-12 col-sm-2"><?php echo __('Flag'); ?>:</label>
        <div class="col-xs-12 col-sm-8">

            <select id="c-flag" data-rule="" class="form-control selectpicker" multiple="" name="row[flag][]">
                <?php if(is_array($flagList) || $flagList instanceof \think\Collection || $flagList instanceof \think\Paginator): if( count($flagList)==0 ) : echo "" ;else: foreach($flagList as $key=>$vo): ?>
                <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['flag'])?$row['flag']:explode(',',$row['flag']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
      <div class="form-group">
        <label for="c-columnimage" class="control-label col-xs-12 col-sm-2">栏目大图:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-columnimage" data-rule="" class="form-control" size="50" name="row[columnimage]" type="text" value="<?php echo htmlentities($row['columnimage']); ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-columnimage" class="btn btn-danger plupload" data-input-id="c-columnimage" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-columnimage"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-columnimage" class="btn btn-primary fachoose" data-input-id="c-columnimage" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-columnimage"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-columnimage"></ul>
        </div>
    </div>
    <div class="form-group">
        <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('Image'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-image" data-rule="" class="form-control" size="50" name="row[image]" type="text" value="<?php echo htmlentities($row['image']); ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-input-id="c-image" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-image"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-input-id="c-image" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-image"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-image"></ul>
        </div>
    </div>
    
    
    
    
    <div class="form-group">
        <label for="c-content" class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-content" data-rule="required" class="form-control editor" rows="25" name="row[content]" cols="50"><?php echo htmlentities($row['content']); ?></textarea>
            <div style="margin-top:5px;">
                <a href="javascript:" class="btn btn-xs btn-primary btn-legal"><?php echo __('Check content is legal'); ?></a>
                <a href="javascript:" class="btn btn-xs btn-danger btn-keywords"><?php echo __('Get the keyword and description'); ?></a>
            </div>
        </div>
    </div>
 
 
 <div class="form-group">
                                <label for="c-image" class="control-label col-xs-12 col-sm-2">图册:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <input id="c-images" class="form-control" size="50" name="row[images]" type="text" value="<?php echo htmlentities($row['images']); ?>" placeholder="组图可以直接从正文进行提取">
                                        <div class="input-group-addon no-border no-padding">
                                            <span><button type="button" id="plupload-images" class="btn btn-danger plupload" data-input-id="c-images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp,image/webp" data-multiple="true" data-preview-id="p-images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                                            <span><button type="button" id="fachoose-images" class="btn btn-primary fachoose" data-input-id="c-images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                                        </div>
                                        <span class="msg-box n-right" for="c-images"></span>
                                    </div>
                                    <!--<ul class="row list-inline plupload-preview" id="p-images"></ul>-->
                                     <ul class="row list-inline plupload-preview" id="p-images" data-template="introtpl" data-name="row[intro]"></ul>
                                    <textarea name="row[intro]" class="form-control"  style="margin-top:5px;display: none"><?php echo $row['intro']; ?></textarea>
                       <!--这里自定义图片预览的模板 开始-->
                                            <script type="text/html" id="introtpl">
                                                <li class="col-xs-3">
                                                    <a href="<%=fullurl%>" data-url="<%=url%>" target="_blank" class="thumbnail">
                                                        <img src="<%=fullurl%>" class="img-responsive">
                                                    </a>
                                                    <input type="text" name="row[intro][<%=index%>]" required="" class="form-control" placeholder="请输入文件描述" value="<%=value?value:''%>"/>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs btn-trash"><i class="fa fa-trash"></i></a>
                                                </li>
                                            </script>
                        <!--这里自定义图片预览的模板 结束-->
                                </div>
                            </div>
                            
                                  <div class="form-group">
                                <label for="c-image" class="control-label col-xs-12 col-sm-2">图文列表:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <input id="c-imageslist" class="form-control" size="50" name="row[imageslist]" type="text" value="<?php echo htmlentities($row['imageslist']); ?>" placeholder="可上传多张图片">
                                        <div class="input-group-addon no-border no-padding">
                                            <span><button type="button" id="plupload-imageslist" class="btn btn-danger plupload" data-input-id="c-imageslist" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp,image/webp" data-multiple="true" data-preview-id="p-imageslist"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                                            <span><button type="button" id="fachoose-imageslist" class="btn btn-primary fachoose" data-input-id="c-imageslist" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                                        </div>
                                        <span class="msg-box n-right" for="c-imageslist"></span>
                                    </div>
                                    <!--<ul class="row list-inline plupload-preview" id="p-imageslist"></ul>-->
                                     <ul class="row list-inline plupload-preview" id="p-imageslist" data-template="imageslist" data-name="row[imgintro]"></ul>
                                    <textarea name="row[imgintro]" class="form-control"  style="margin-top:5px;display: none"><?php echo $row['imgintro']; ?></textarea>
                       <!--这里自定义图片预览的模板 开始-->
                                            <script type="text/html" id="imageslist">
                                                <li class="col-xs-6">
                                                    <a href="<%=fullurl%>" data-url="<%=url%>" target="_blank" class="thumbnail">
                                                        <img src="<%=fullurl%>" class="img-responsive">
                                                    </a>
                                                    <input type="text" name="row[imgintro][<%=index%>][info]" class="form-control" placeholder="请输入标题" value="<%=value?value['info']:''%>"/>
                                                     <textarea class="form-control" type="text" placeholder="请输入描述" name="row[imgintro][<%=index%>][txt]"><%=value?value['txt']:''%></textarea>
                                                    <a href="javascript:;" class="btn btn-danger btn-xs btn-trash"><i class="fa fa-trash"></i></a>
                                                </li>
                                            </script>
                        <!--这里自定义图片预览的模板 结束-->
                                </div>
                            </div>
        
 
    <div class="form-group">
        <label for="c-seotitle" class="control-label col-xs-12 col-sm-2"><?php echo __('Seotitle'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-seotitle" data-rule="" class="form-control" name="row[seotitle]" type="text" value="<?php echo htmlentities($row['seotitle']); ?>" placeholder="为空时将使用单页标题">
        </div>
    </div>
    <div class="form-group">
        <label for="c-keywords" class="control-label col-xs-12 col-sm-2"><?php echo __('Keywords'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-keywords" data-rule="" class="form-control" name="row[keywords]" type="text" value="<?php echo htmlentities($row['keywords']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="c-description" class="control-label col-xs-12 col-sm-2"><?php echo __('Description'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-description" data-rule="" class="form-control" name="row[description]"><?php echo htmlentities($row['description']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-diyname" class="control-label col-xs-12 col-sm-2"><?php echo __('Diyname'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-diyname" data-rule="required;diyname" class="form-control" name="row[diyname]" type="text" value="<?php echo $row['diyname']; ?>" data-tip="用于伪静态规则中[:diyname]替换">
        </div>
    </div>
    <div class="form-group">
        <label for="c-showtpl" class="control-label col-xs-12 col-sm-2"><?php echo __('Showtpl'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-showtpl" data-rule="" class="form-control selectpage" name="row[showtpl]" data-source="cms/ajax/get_template_list" data-params='{"type":"page"}' data-primary-key="name" data-field="name" placeholder="自定义模板文件必须以page开头" type="text" value="<?php echo $row['showtpl']; ?>">
        </div>
    </div>
    <div class="form-group hide">
        <label for="c-views" class="control-label col-xs-12 col-sm-2"><?php echo __('Views'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-views" data-rule="required" class="form-control" name="row[views]" type="number" value="<?php echo $row['views']; ?>">
        </div>
    </div>
    <div class="form-group hide">
        <label for="c-comments" class="control-label col-xs-12 col-sm-2"><?php echo __('Comments'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-comments" data-rule="required" class="form-control" name="row[comments]" type="number" value="<?php echo $row['comments']; ?>">
        </div>
    </div>
    <div class="form-group hide">
        <label for="c-weigh" class="control-label col-xs-12 col-sm-2"><?php echo __('Weigh'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-weigh" data-rule="required" class="form-control" name="row[weigh]" type="number" value="<?php echo $row['weigh']; ?>">
        </div>
    </div>
    <div class="form-group hide">
        <label class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Iscomment'); ?>:</label>
        <div class="col-xs-12 col-sm-8 col-md-8">
            <input  id="c-iscomment" name="row[iscomment]" type="hidden" value="<?php echo $row['iscomment']; ?>">
            <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-iscomment" data-yes="1" data-no="0" >
                <i class="fa fa-toggle-on text-success <?php if($row['iscomment'] == '0'): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
            </a>
        </div>
    </div>
    <div class="form-group hide">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Parsetpl'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input  id="c-parsetpl" name="row[parsetpl]" type="hidden" value="<?php echo $row['parsetpl']; ?>">
            <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-parsetpl" data-yes="1" data-no="0" >
                <i class="fa fa-toggle-on text-success <?php if($row['parsetpl'] == '0'): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
            </a>
        </div>
    </div>
    <div id="extend"><style>
    .font-bold {
        font-weight: bold;
    }

    .font-underline {
        font-weight: bold;
    }

    .radio-inline, .checkbox-inline {
        padding-left: 0;
    }
</style>
<!--@formatter:off-->
<?php foreach($fields as $item): ?>

<div class="form-group">
    <div class="control-label col-xs-12 col-sm-2"><?php echo $item['title']; ?></div>
    <div class="col-xs-12 col-sm-8">
        <?php switch($item['type']): case "string": ?>
        <input <?php echo $item['extend_html']; ?> type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo htmlentities($item['value']); ?>" class="form-control" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" />
        <?php break; case "text": case "editor": ?>
        <textarea <?php echo $item['extend_html']; ?> name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" class="form-control <?php if($item['type'] == 'editor'): ?>editor<?php endif; ?>" data-rule="<?php echo $item['rule']; ?>" rows="20" data-tip="<?php echo $item['tip']; ?>"><?php echo htmlentities($item['value']); ?></textarea>
        <?php break; case "array": if($item['name']=='downloadurl'): $item['value']=isset($values[$item['name']])?$item['value']:$item['download_list']; ?>
        <dl <?php echo $item['extend_html']; ?> class="fieldlist downloadlist" data-name="row[<?php echo $item['name']; ?>]" data-template="downloadurltpl">
            <dd class="hide">
                <ins style="width:70px;">标题</ins>
                <ins style="width:70px;">图片</ins>
                <ins>描述</ins>
            </dd>
            <dd><a href="javascript:;" class="btn btn-sm btn-success btn-append"><i class="fa fa-plus"></i> <?php echo __('Append'); ?></a></dd>
            <textarea name="row[<?php echo $item['name']; ?>]" class="form-control hide" cols="30" rows="5"><?php echo htmlentities($item['value']); ?></textarea>
        </dl>
        <?php else: $arrList=isset($values[$item['name']])?(array)json_decode($item['value'],true):$item['content_list']; ?>
        <dl <?php echo $item['extend_html']; ?> class="fieldlist" data-name="row[<?php echo $item['name']; ?>]" data-template="basictpl">
            <dd class="hide">
                <ins><?php echo isset($item["setting"]["key"])&&$item["setting"]["key"]?$item["setting"]["key"]:__('Array key'); ?></ins>
                <ins><?php echo isset($item["setting"]["value"])&&$item["setting"]["value"]?$item["setting"]["value"]:__('Array value'); ?></ins>
            </dd>

            <dd><a href="javascript:;" class="append btn btn-sm btn-success"><i class="fa fa-plus"></i> <?php echo __('Append'); ?></a></dd>
            <textarea name="row[<?php echo $item['name']; ?>]" class="form-control hide" cols="30" rows="5"><?php echo htmlentities(json_encode($arrList)); ?></textarea>
        </dl>
        <!-- 数组字段模板开始 -->
        <script id="basictpl" type="text/html">
                                <dd class="form-inline">
                                    <input style="width: calc(100% - 80px);" type="text" name="<%=name%>[<%=index%>][title]" class="form-control" value="<%=row.title%>" placeholder="标题" size="10"/>
                                    <span class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></span>
                                    <span class="btn btn-sm btn-primary btn-dragsort"><i class="fa fa-arrows"></i></span>
                                    <textarea style="width: calc(100% - 80px); margin-top: 2px;" type="text" name="<%=name%>[<%=index%>][intro]"  class="form-control" value="<%=row.intro%>"placeholder="描述"  rows="3"><%=row.intro%></textarea>
                                </dd>
         </script>
         <!-- 数组字段模板开始 -->
        <?php endif; break; case "date": ?>
        <input <?php echo $item['extend_html']; ?> type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo htmlentities($item['value']); ?>" class="form-control datetimepicker" data-date-format="YYYY-MM-DD" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" />
        <?php break; case "time": ?>
        <input <?php echo $item['extend_html']; ?> type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo htmlentities($item['value']); ?>" class="form-control datetimepicker" data-date-format="HH:mm:ss" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" />
        <?php break; case "datetime": ?>
        <input <?php echo $item['extend_html']; ?> type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo htmlentities($item['value']); ?>" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" />
        <?php break; case "datetimerange": ?>
        <input <?php echo $item['extend_html']; ?> type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo htmlentities($item['value']); ?>" class="form-control datetimerange" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>"/>
        <?php break; case "number": ?>
        <input <?php echo $item['extend_html']; ?> type="number" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo htmlentities($item['value']); ?>" class="form-control" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" />
        <?php break; case "checkbox": if(is_array($item['content_list']) || $item['content_list'] instanceof \think\Collection || $item['content_list'] instanceof \think\Paginator): if( count($item['content_list'])==0 ) : echo "" ;else: foreach($item['content_list'] as $key=>$vo): ?>
        <div class="checkbox checkbox-inline">
            <label for="row[<?php echo $item['name']; ?>][]-<?php echo $key; ?>"><input id="row[<?php echo $item['name']; ?>][]-<?php echo $key; ?>" name="row[<?php echo $item['name']; ?>][]" type="checkbox" value="<?php echo $key; ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" <?php if(in_array(($key), is_array($item['value'])?$item['value']:explode(',',$item['value']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; break; case "radio": if(is_array($item['content_list']) || $item['content_list'] instanceof \think\Collection || $item['content_list'] instanceof \think\Paginator): if( count($item['content_list'])==0 ) : echo "" ;else: foreach($item['content_list'] as $key=>$vo): ?>
        <div class="radio radio-inline">
            <label for="row[<?php echo $item['name']; ?>]-<?php echo $key; ?>"><input id="row[<?php echo $item['name']; ?>]-<?php echo $key; ?>" name="row[<?php echo $item['name']; ?>]" type="radio" value="<?php echo $key; ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" <?php if(in_array(($key), is_array($item['value'])?$item['value']:explode(',',$item['value']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; break; case "select": case "selects": ?>
        <select <?php echo $item['extend_html']; ?> name="row[<?php echo $item['name']; ?>]<?php echo $item['type']=='selects'?'[]':''; ?>" class="form-control selectpicker" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>" <?php echo $item['type']=='selects'?'multiple':''; ?>>
            <?php if(is_array($item['content_list']) || $item['content_list'] instanceof \think\Collection || $item['content_list'] instanceof \think\Paginator): if( count($item['content_list'])==0 ) : echo "" ;else: foreach($item['content_list'] as $key=>$vo): ?>
            <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($item['value'])?$item['value']:explode(',',$item['value']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <?php break; case "image": case "images": ?>
        <div class="input-group">
            <input id="c-<?php echo $item['name']; ?>" class="form-control" name="row[<?php echo $item['name']; ?>]" type="text" value="<?php echo htmlentities($item['value']); ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>">
            <div class="input-group-addon no-border no-padding">
                <span><button type="button" id="plupload-<?php echo $item['name']; ?>" class="btn btn-danger plupload" data-input-id="c-<?php echo $item['name']; ?>" data-preview-id="p-<?php echo $item['name']; ?>" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp,image/webp" data-multiple="<?php echo $item['type']=='image'?'false':'true'; ?>" <?php if($item['maximum']): ?>data-maxcount="<?php echo $item['maximum']; ?>" <?php endif; ?>><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                <span><button type="button" id="fachoose-<?php echo $item['name']; ?>" class="btn btn-primary fachoose" data-input-id="c-<?php echo $item['name']; ?>" data-preview-id="p-<?php echo $item['name']; ?>" data-mimetype="image/*" data-multiple="<?php echo $item['type']=='image'?'false':'true'; ?>" <?php if($item['maximum']): ?>data-maxcount="<?php echo $item['maximum']; ?>" <?php endif; ?>><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
            </div>
            <span class="msg-box n-right" for="c-<?php echo $item['name']; ?>"></span>
        </div>
       <ul class="row list-inline plupload-preview" id="p-<?php echo $item['name']; ?>"></ul>
    
        <?php break; case "file": case "files": ?>
        <div class="input-group">
            <input id="c-<?php echo $item['name']; ?>" class="form-control" name="row[<?php echo htmlentities($item['name']); ?>]" type="text" value="<?php echo $item['value']; ?>" data-rule="<?php echo $item['rule']; ?>" data-tip="<?php echo $item['tip']; ?>">
            <div class="input-group-addon no-border no-padding">
                <span><button type="button" id="plupload-<?php echo $item['name']; ?>" class="btn btn-danger plupload" data-input-id="c-<?php echo $item['name']; ?>" data-multiple="<?php echo $item['type']=='file'?'false':'true'; ?>" <?php if($item['maximum']): ?>data-maxcount="<?php echo $item['maximum']; ?>" <?php endif; ?>><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                <span><button type="button" id="fachoose-<?php echo $item['name']; ?>" class="btn btn-primary fachoose" data-input-id="c-<?php echo $item['name']; ?>" data-multiple="<?php echo $item['type']=='file'?'false':'true'; ?>" <?php if($item['maximum']): ?>data-maxcount="<?php echo $item['maximum']; ?>" <?php endif; ?>><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
            </div>
            <span class="msg-box n-right" for="c-<?php echo $item['name']; ?>"></span>
        </div>
        <?php break; case "switch": ?>
        <input id="c-<?php echo $item['name']; ?>" name="row[<?php echo $item['name']; ?>]" type="hidden" value="<?php echo $item['value']?1:0; ?>">
        <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-<?php echo $item['name']; ?>" data-yes="1" data-no="0">
            <i class="fa fa-toggle-on text-success <?php if(!$item['value']): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
        </a>
        <?php break; case "bool": ?>
        <label for="row[<?php echo $item['name']; ?>]-yes"><input id="row[<?php echo $item['name']; ?>]-yes" name="row[<?php echo $item['name']; ?>]" type="radio" value="1" <?php echo !empty($item['value'])?'checked':''; ?> data-tip="<?php echo $item['tip']; ?>" /> <?php echo __('Yes'); ?></label>
        <label for="row[<?php echo $item['name']; ?>]-no"><input id="row[<?php echo $item['name']; ?>]-no" name="row[<?php echo $item['name']; ?>]" type="radio" value="0" <?php echo !empty($item['value'])?'':'checked'; ?> data-tip="<?php echo $item['tip']; ?>" /> <?php echo __('No'); ?></label>
        <?php break; case "city": ?>
        <div style="position:relative">
        <input <?php echo $item['extend_html']; ?> type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo htmlentities($item['value']); ?>" class="form-control" data-toggle="city-picker" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" />
        </div>
        <?php break; case "selectpage": case "selectpages": ?>
        <input <?php echo $item['extend_html']; ?> type="text" name="row[<?php echo $item['name']; ?>]" id="c-<?php echo $item['name']; ?>" value="<?php echo htmlentities($item['value']); ?>" class="form-control selectpage" data-source="<?php echo addon_url('cms/ajax/selectpage'); ?>?id=<?php echo $item['id']; ?>&admin=1" data-primary-key="<?php echo $item['setting']['primarykey']; ?>" data-field="<?php echo $item['setting']['field']; ?>" data-multiple="<?php echo $item['type']=='selectpage'?'false':'true'; ?>" data-tip="<?php echo $item['tip']; ?>" data-rule="<?php echo $item['rule']; ?>" />
        <?php break; case "custom": ?>
        <?php echo $item['extend_html']; break; endswitch; ?>
    </div>
</div>
<?php endforeach; ?>
<!--@formatter:on-->

<script type="text/html" id="downloadurltpl">
    <dd class="form-inline" style="margin-bottom: 20px;">
        <input type="text" placeholder="标题" name="<%=name%>[<%=index%>][name]" class="form-control" value="<%=row.name%>" style="width: calc(100% - 80px);"/>
        <input type="text" placeholder="图片" name="<%=name%>[<%=index%>][url]" id="c-downloadurl-<%=index%>" class="form-control" value="<%=row.url%>" style="width: calc(100% - 80px);"/>
        <div class="btn-group">
            <button type="button" id="plupload-downloadurl-<%=index%>" class="btn btn-danger plupload" data-input-id="c-downloadurl-<%=index%>" data-mimetype="*" data-multiple="false"><i class="fa fa-upload"></i></button>
            <button type="button" id="fachoose-downloadurl-<%=index%>" class="btn btn-primary fachoose" data-input-id="c-downloadurl-<%=index%>" data-mimetype="*" data-multiple="false"><i class="fa fa-list"></i></button>
        </div>
       <textarea style="width: calc(100% - 80px); margin-top: -1px;" type="text" name="<%=name%>[<%=index%>][password]"  class="form-control" value="<%=row.intro%>"placeholder="描述"  rows="3"><%=row.password%></textarea>
        <span class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></span> <span class="btn btn-sm btn-primary btn-dragsort"><i class="fa fa-arrows"></i></span>
    </dd>
</script>



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
