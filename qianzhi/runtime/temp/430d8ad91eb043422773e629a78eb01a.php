<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:96:"/Users/panliu/Documents/project/zjs-copy/public/../application/admin/view/cms/archives/edit.html";i:1634956115;s:83:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/layout/default.html";i:1611580232;s:80:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/meta.html";i:1611580232;s:88:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/cms/archives/common.html";i:1611729154;s:82:"/Users/panliu/Documents/project/zjs-copy/application/admin/view/common/script.html";i:1611580232;}*/ ?>
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
                                <style>
    .autocomplete-searchtitle {
        padding: 0px 8px;
    }

    .autocomplete-searchtitle .media {
        border-bottom: 1px solid #eee;
        margin-top: 10px;
        padding-bottom: 10px;
    }

    .autocomplete-searchtitle .media:last-child {
        border-bottom: 0;
    }

    .autocomplete-searchtitle .media h4.media-heading {
        font-size: 14px;
    }
    .autocomplete-searchtitle .media .text-muted {
        font-size: 12px;
    }

    .autocomplete-searchtitle .media:hover {
        background: #fefefe;
    }
</style>

<script type="text/html" id="headertpl">
    <div class="px-2">
        <div class="row">
            <div class="col-12">
                <div class="alert" style="border-radius: 0;color: #0084ff; background: rgba(0, 132, 255, 0.1);margin-bottom:0;">
                    共找到以下几篇相关文章:
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text/html" id="itemtpl">
    <div class="media">
        <a class="" href="<%=item.url%>" target="_blank">
            <div class="media-left">
                <img src="<%=item.image%>" style="width: 50px; height: 50px;">
            </div>

            <div class="media-body">
                <h4 class="media-heading"><%=#replace(item.title)%></h4>
                <div class="text-muted"><%=#formatter.status.call(context, item.status, item)%></div>
            </div>
        </a>
    </div>
</script>

<form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
    <input type="hidden" value="<?php echo $row['id']; ?>" id="archive-id"/>
    <input type="hidden" name="row[style]" value="<?php echo $row['style']; ?>"/>
    <div class="row">
        <div class="col-md-9 col-sm-12">
            <div class="panel panel-default panel-intro">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#basic" data-toggle="tab">基础信息</a></li>
                    </ul>
                </div>
                <div class="panel-body">

                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="basic">
                            <div class="form-group">
                                <label for="c-channel_id" class="control-label col-xs-12 col-sm-2"><?php echo __('Channel_id'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <select id="c-channel_id" data-rule="required" class="form-control selectpicker" data-live-search="true" name="row[channel_id]">
                                        <?php echo $channelOptions; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label for="c-channel_ids" class="control-label col-xs-12 col-sm-2"><?php echo __('Channel_ids'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <select id="c-channel_ids" data-rule="" class="form-control selectpicker" multiple data-live-search="true" name="row[channel_ids][]">
                                        <?php echo $secondChannelOptions; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label for="c-user_id" class="control-label col-xs-12 col-sm-2"><?php echo __('User_id'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="c-user_id" type="text" class="form-control selectpage" data-source="user/user/index" placeholder="发布会员,可为空" data-field="nickname" name="row[user_id]" value="<?php echo $row['user_id']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label for="c-special_ids" class="control-label col-xs-12 col-sm-2"><?php echo __('Special_ids'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="c-special_ids" type="text" class="form-control selectpage" data-source="cms/special/index" data-multiple="true" placeholder="所属专题,可为空" data-field="title" name="row[special_ids]" value="<?php echo $row['special_ids']; ?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-title" class="control-label col-xs-12 col-sm-2"><?php echo __('Title'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <input id="c-title" data-rule="required" class="form-control <?php echo $row['style_bold']?'text-bold':''; ?>" name="row[title]" type="text" value="<?php echo htmlentities($row['title']); ?>" data-suggestion-url="<?php echo url('cms.archives/suggestion'); ?>?id=<?php echo $row['id']; ?>" style="color:<?php echo $row['style_color']?$row['style_color']:'inherit'; ?>;">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default btn-bold <?php echo $row['style_bold']?'text-bold active':''; ?>" style="margin:0 1px;" type="button">粗</button>
                                        <button type="button" class="btn btn-default btn-color colorpicker <?php echo $row['style_color']?'active':''; ?>" style="padding:0;margin-left:1px;" title="选择标题颜色"><img src="/assets/addons/cms/img/colorful.png" height="29" alt=""></button>
                                        <span class="msg-box n-right" for="c-title"></span>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('Image'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <div class="input-group">
                                        <input id="c-image" class="form-control" size="50" name="row[image]" type="text" value="<?php echo htmlentities($row['image']); ?>" placeholder="缩略图可以直接从正文进行提取">
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
                                <label for="c-image" class="control-label col-xs-12 col-sm-2"><?php echo __('Images'); ?>:</label>
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
                            <div class="form-group hide">
                                <label for="c-tags" class="control-label col-xs-12 col-sm-2"><?php echo __('Tags'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="c-tags" data-rule="" class="form-control" placeholder="多个关键词以,隔开 输入后空格确认,可以为空" name="row[tags]" type="text" value="<?php echo htmlentities($row['tags']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="c-diyname" class="control-label col-xs-12 col-sm-2"><?php echo __('Diyname'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input type="text" id="c-diyname" data-rule="diyname" name="row[diyname]" class="form-control" placeholder="请输入自定义的名称" value="<?php echo $row['diyname']; ?>" data-tip="用于伪静态规则中[:diyname]替换"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-content" class="control-label col-xs-12 col-sm-2"><?php echo __('Content'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <textarea id="c-content" data-rule="" class="form-control editor" name="row[content]" rows="20"><?php echo htmlentities($row['content']); ?></textarea>
                                    <div style="margin-top:5px;" class="hide">
                                        <a href="javascript:" class="btn btn-xs btn-primary btn-legal"><i class="fa fa-magic"></i> <?php echo __('Check content is legal'); ?></a>
                                        <a href="javascript:" class="btn btn-xs btn-danger btn-keywords"><i class="fa fa-file"></i> <?php echo __('Get the keyword and description'); ?></a>
                                        <a href="javascript:" class="btn btn-xs btn-info btn-getimage" data-toggle="tooltip" data-title="将提取内容第一张图作为缩略图"><i class="fa fa-camera"></i> <?php echo __('提取缩略图'); ?></a>
                                        <a href="javascript:" class="btn btn-xs btn-info btn-getimages" data-toggle="tooltip" data-title="将提取内容前4张图作为组图"><i class="fa fa-camera"></i> <?php echo __('提取组图'); ?></a>
                                        <div style="margin-top:5px;">
                                            <a href="javascript:" class="btn btn-xs btn-success btn-paytag" data-toggle="tooltip" data-title="只针对付费文章有效"><i class="fa fa-cny"></i> <?php echo __('付费可见标签'); ?></a>
                                            <button type="button" class="btn btn-xs btn-success btn-pagertag"><i class="fa fa-list"></i> <?php echo __('文章分页标签'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label for="c-seotitle" class="control-label col-xs-12 col-sm-2"><?php echo __('Seotitle'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="c-seotitle" data-rule="" class="form-control" name="row[seotitle]" type="text" value="<?php echo htmlentities($row['seotitle']); ?>" placeholder="为空时将使用文档标题">
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label for="c-keywords" class="control-label col-xs-12 col-sm-2"><?php echo __('Keywords'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <input id="c-keywords" data-rule="" class="form-control" name="row[keywords]" type="text" value="<?php echo htmlentities($row['keywords']); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-description" class="control-label col-xs-12 col-sm-2"><?php echo __('Description'); ?>:</label>
                                <div class="col-xs-12 col-sm-8">
                                    <textarea id="c-description" cols="60" rows="3" data-rule="" class="form-control" name="row[description]"><?php echo htmlentities($row['description']); ?></textarea>
                                </div>
                            </div>
                            <div id="extend"></div>
                        </div>
                    </div>
                    <div class="form-group layer-footer">
                        <label class="control-label col-xs-12 col-sm-2"></label>
                        <div class="col-xs-12 col-sm-8">
                            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
                            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-3 col-sm-12">
            <div class="panel panel-default panel-intro">
                <div class="panel-heading">
                    <div class="panel-lead"><em>相关信息</em></div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active in">
                            <div class="form-group hide">
                                <label for="c-views" class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Views'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class="input-group margin-bottom-sm">

                                        <input id="c-views" data-rule="required" class="form-control" name="row[views]" placeholder="<?php echo __('Views'); ?>" type="number" value="<?php echo $row['views']; ?>">
                                        <span class="input-group-addon"><i class="fa fa-eye text-success"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label for="c-comments" class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Comments'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class="input-group margin-bottom-sm">

                                        <input id="c-comments" data-rule="required" class="form-control" name="row[comments]" placeholder="<?php echo __('Comments'); ?>" type="number" value="<?php echo $row['comments']; ?>">
                                        <span class="input-group-addon"><i class="fa fa-comment text-info"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label for="c-likes" class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Likes'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class="input-group margin-bottom-sm">

                                        <input id="c-likes" data-rule="required" class="form-control" name="row[likes]" placeholder="<?php echo __('Likes'); ?>" type="number" value="<?php echo $row['likes']; ?>">
                                        <span class="input-group-addon"><i class="fa fa-thumbs-up text-danger"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label for="c-dislikes" class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Dislikes'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class="input-group margin-bottom-sm">
                                        <input id="c-dislikes" data-rule="required" class="form-control" name="row[dislikes]" placeholder="<?php echo __('Dislikes'); ?>" type="number" value="<?php echo $row['dislikes']; ?>">
                                        <span class="input-group-addon"><i class="fa fa-thumbs-down text-gray"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="c-weigh" class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Weigh'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <input id="c-weigh" data-rule="required" class="form-control" name="row[weigh]" placeholder="<?php echo __('Weigh'); ?>" type="number" value="<?php echo $row['weigh']; ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-intro">
                <div class="panel-heading">
                    <div class="panel-lead"><em>状态</em></div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active in">
                            <div class="form-group">
                                <label for="c-flag" class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Flag'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">

                                    <select id="c-flag" class="form-control selectpicker" multiple="" name="row[flag][]">
                                        <?php if(is_array($flagList) || $flagList instanceof \think\Collection || $flagList instanceof \think\Paginator): if( count($flagList)==0 ) : echo "" ;else: foreach($flagList as $key=>$vo): ?>
                                        <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['flag'])?$row['flag']:explode(',',$row['flag']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Status'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <select id="c-status" class="form-control selectpicker" name="row[status]">
                                        <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
                                        <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['status'])?$row['status']:explode(',',$row['status']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Isguest'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <input  id="c-isguest" name="row[isguest]" type="hidden" value="<?php echo $row['isguest']; ?>">
                                    <a href="javascript:;" data-toggle="switcher" class="btn-switcher" data-input-id="c-isguest" data-yes="1" data-no="0" >
                                        <i class="fa fa-toggle-on text-success <?php if($row['isguest'] == '0'): ?>fa-flip-horizontal text-gray<?php endif; ?> fa-2x"></i>
                                    </a>
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
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Createtime'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class='input-group date datetimepicker'>
                                        <input type='text' name="row[createtime]" data-rule="required" data-date-format="YYYY-MM-DD HH:mm:ss" value="<?php echo datetime($row['createtime']); ?>" class="form-control datetimepicker"/>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-2 col-md-3"><?php echo __('Publishtime'); ?>:</label>
                                <div class="col-xs-12 col-sm-8 col-md-8">
                                    <div class='input-group date datetimepicker'>
                                        <input type='text' name="row[publishtime]" data-rule="required(isnormal)" data-date-format="YYYY-MM-DD HH:mm:ss" value="<?php echo $row['publishtime_text']; ?>" class="form-control datetimepicker"/>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
