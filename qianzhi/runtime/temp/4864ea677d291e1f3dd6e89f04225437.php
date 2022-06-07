<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:95:"/Users/panliu/Documents/project/zjs-copy/public/../application/admin/view/cms/channel/edit.html";i:1617889268;s:83:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/layout/default.html";i:1611580232;s:80:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/meta.html";i:1611580232;s:86:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/cms/common/fields.html";i:1649302861;s:82:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/script.html";i:1611580232;}*/ ?>
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
    <input type="hidden" value="<?php echo $row['id']; ?>" id="channel-id" />
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="radio">
                <?php if(is_array($typeList) || $typeList instanceof \think\Collection || $typeList instanceof \think\Paginator): if( count($typeList)==0 ) : echo "" ;else: foreach($typeList as $key=>$vo): ?>
                <label for="row[type]-<?php echo $key; ?>"><input id="row[type]-<?php echo $key; ?>" name="row[type]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['type'])?$row['type']:explode(',',$row['type']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
    <div class="form-group tf tf-list tf-channel tf-link">
        <label for="c-model_id" class="control-label col-xs-12 col-sm-2"><?php echo __('Model_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select name="row[model_id]" id="c-model_id" class="form-control" <?php if($hasArchives): ?>disabled<?php endif; ?>>
                <?php if(is_array($modelList) || $modelList instanceof \think\Collection || $modelList instanceof \think\Paginator): if( count($modelList)==0 ) : echo "" ;else: foreach($modelList as $key=>$vo): ?>
                <option <?php if(in_array(($vo['id']), is_array($row['model_id'])?$row['model_id']:explode(',',$row['model_id']))): ?>selected="selected"<?php endif; ?> value="<?php echo $vo['id']; ?>" data-channeltpl="<?php echo $vo['channeltpl']; ?>" data-listtpl="<?php echo $vo['listtpl']; ?>" data-showtpl="<?php echo $vo['showtpl']; ?>"><?php echo $vo['name']; if($hasArchives && $row['model_id']==$vo['id']): ?> (当栏目下有文档时将无法变更模型)<?php endif; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="parent_id" class="control-label col-xs-12 col-sm-2"><?php echo __('上级栏目'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <select name="row[parent_id]" data-rule="required" id="parent_id" class="form-control">
                <option value="0"><?php echo __('None'); ?></option>
                <?php if(is_array($channelList) || $channelList instanceof \think\Collection || $channelList instanceof \think\Paginator): if( count($channelList)==0 ) : echo "" ;else: foreach($channelList as $key=>$vo): ?>
                <option value="<?php echo $vo['id']; ?>" <?php if(in_array(($vo['id']), is_array($childrenIds)?$childrenIds:explode(',',$childrenIds))): ?>disabled<?php endif; if($vo['type']!=='link'): ?>data-model="<?php echo $vo['model_id']; ?>"<?php endif; if($vo['id']==$row['parent_id']): ?> selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="c-name" class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-name" data-rule="required" class="form-control" name="row[name]" type="text" value="<?php echo htmlentities($row['name']); ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('Image'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-image" data-rule="" class="form-control" size="50" name="row[image]" type="text" value="<?php echo htmlentities($row['image']); ?>">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-image" class="btn btn-danger plupload" data-input-id="c-image" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp,image/webp" data-multiple="false" data-preview-id="p-image"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-image" class="btn btn-primary fachoose" data-input-id="c-image" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-image"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-image"></ul>
        </div>
    </div>
    <div class="form-group">
        <label for="c-seotitle" class="control-label col-xs-12 col-sm-2"><?php echo __('Seotitle'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-seotitle" data-rule="" class="form-control" name="row[seotitle]" type="text" value="<?php echo htmlentities($row['seotitle']); ?>" placeholder="为空时将使用栏目名称">
        </div>
    </div>
    <div class="form-group tf tf-channel tf tf-list">
        <label for="c-keywords" class="control-label col-xs-12 col-sm-2"><?php echo __('Keywords'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-keywords" data-rule="" class="form-control" name="row[keywords]" type="text" value="<?php echo htmlentities($row['keywords']); ?>">
        </div>
    </div>
    <div class="form-group tf tf-channel tf tf-list">
        <label for="c-description" class="control-label col-xs-12 col-sm-2"><?php echo __('Description'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-description" data-rule="" class="form-control" name="row[description]"><?php echo htmlentities($row['description']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="c-diyname" class="control-label col-xs-12 col-sm-2"><?php echo __('Diyname'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-diyname" data-rule="required; diyname" class="form-control" name="row[diyname]" type="text" value="<?php echo htmlentities($row['diyname']); ?>" data-tip="用于伪静态规则中[:diyname]替换">
        </div>
    </div>
    <div class="form-group tf tf-link">
        <label for="c-outlink" class="control-label col-xs-12 col-sm-2"><?php echo __('Outlink'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-outlink" data-rule="required" class="form-control" name="row[outlink]" type="text" value="<?php echo htmlentities($row['outlink']); ?>">
                <span class="input-group-btn">
                    <a href="javascript:" data-url="cms/ajax/get_link_list" class="btn btn-primary btn-select-link" title="选择链接" style="margin-left:3px;"><i class="fa fa-link"></i> 选择链接</a>
                </span>
                <span class="msg-box n-right"></span>
            </div>
        </div>
    </div>
    <div class="form-group tf tf-channel tf-list">
        <label for="c-channeltpl" class="control-label col-xs-12 col-sm-2"><?php echo __('Channeltpl'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-channeltpl" data-rule="required" class="form-control selectpage" name="row[channeltpl]" data-source="cms/ajax/get_template_list" data-params='{"type":"channel"}' data-primary-key="name" data-field="name" type="text" value="<?php echo $row['channeltpl']; ?>" placeholder="自定义模板文件必须以channel开头">
        </div>
    </div>
    <div class="form-group tf tf-channel tf-list">
        <label for="c-listtpl" class="control-label col-xs-12 col-sm-2"><?php echo __('Listtpl'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-listtpl" data-rule="required" class="form-control selectpage" name="row[listtpl]" data-source="cms/ajax/get_template_list" data-params='{"type":"list"}' data-primary-key="name" data-field="name" type="text" value="<?php echo $row['listtpl']; ?>" placeholder="自定义模板文件必须以list开头">
        </div>
    </div>
    <div class="form-group tf tf-channel tf-list">
        <label for="c-showtpl" class="control-label col-xs-12 col-sm-2"><?php echo __('Showtpl'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-showtpl" data-rule="required" class="form-control selectpage" name="row[showtpl]" data-source="cms/ajax/get_template_list" data-params='{"type":"show"}' data-primary-key="name" data-field="name" type="text" value="<?php echo $row['showtpl']; ?>" placeholder="自定义模板文件必须以show开头">
        </div>
    </div>
    <div class="form-group tf tf-channel tf-list">
        <label for="c-pagesize" class="control-label col-xs-12 col-sm-2"><?php echo __('Pagesize'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-pagesize" data-rule="required" class="form-control" name="row[pagesize]" type="number" value="<?php echo $row['pagesize']; ?>" data-tip="用于前台列表页分页">
        </div>
    </div>
    <div class="form-group">
        <label for="c-weigh" class="control-label col-xs-12 col-sm-2"><?php echo __('Weigh'); ?>:</label>
        <div class="col-xs-12 col-sm-4">
            <input id="c-weigh" data-rule="required" class="form-control" name="row[weigh]" type="number" value="<?php echo $row['weigh']; ?>" data-tip="权重越大越靠前">
        </div>
    </div>
    <div class="form-group tf tf-channel tf-list">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Iscontribute'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input  id="c-iscontribute" name="row[iscontribute]" type="hidden" value="<?php echo $row['iscontribute']; ?>">
            <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-iscontribute" data-yes="1" data-no="0" >
                <i class="fa fa-toggle-on text-success <?php if($row['iscontribute'] == '0'): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
            </a>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Isnav'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input  id="c-isnav" name="row[isnav]" type="hidden" value="<?php echo $row['isnav']; ?>">
            <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-isnav" data-yes="1" data-no="0" >
                <i class="fa fa-toggle-on text-success <?php if($row['isnav'] == '0'): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
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
