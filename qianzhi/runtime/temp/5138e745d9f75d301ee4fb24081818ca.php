<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:83:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/show_product.html";i:1654617524;s:82:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/meta.html";i:1654271884;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/header.html";i:1654618409;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/footer.html";i:1654524000;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/script.html";i:1654003873;}*/ ?>
<!DOCTYPE html>
<html>

<head>
    

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo htmlentities($site['name']); ?></title>
    <link rel="shortcut icon" href="/assets/img/favicon.ico" />
    <!-- Bootstrap Core CSS -->
    <link href="/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/frontend.min.css">
    <link rel="stylesheet" href="/assets/qianzhi/frontend/common/common.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="/assets/qianzhi/frontend/product/detail/detail.css">
</head>

<body class="product-wrap">
<link rel="stylesheet" href="/assets/qianzhi/frontend/common/header/header.css">

<nav id="page-navbar" class="navbar">
  <div class="container-fluid container-flex">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <div class="logo-wrap d-flex">
              <img src="/assets/img/png/logo.png" alt="logo">
          </div>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <ul class="nav navbar-nav navbar-right">
              <li class="px-4">
<!--                  <?php if(in_array(($site['sousuo']), explode(',',"1"))): ?>-->
<!--                  <form class="navbar-form navbar-left" id="js-search-from" action="/s.html" method="post">-->
<!--                      <div class="form-group">-->
<!--                          <input type="text" class="form-control search-input" id="js-search-input"-->
<!--                                 data-suggestion-url="/addons/cms/search/suggestion.html" placeholder="Search" />-->
<!--                      </div>-->
<!--                      <span class="glyphicon glyphicon-search media-middle cursor-pointer" id="js-search-btn"-->
<!--                          aria-label="search button" aria-hidden="true">-->
<!--                      </span>-->
<!--                  </form>-->
<!--                  <?php endif; ?>-->
                  <form class="navbar-form navbar-left" id="js-search-from">
                      <div class="form-group">
                          <input type="text" class="form-control search-input" id="js-search-input"
                                 placeholder="Search" />
                      </div>
                      <span class="glyphicon glyphicon-search media-middle cursor-pointer" id="js-search-btn"
                            aria-label="search button" aria-hidden="true">
                      </span>
                  </form>
<!--                  <?php if(in_array(($site['sousuo']), explode(',',"1"))): ?>-->
<!--                  <div class="sousuonr">-->
<!--                      <form action="/s.html" method="post">-->
<!--                          <input autocomplete = "off" class="form-control" name="q" data-suggestion-url="/addons/cms/search/suggestion.html" type="text" value="" placeholder="Key words">-->
<!--                          <button class="ico icon-icon-test"></button>-->
<!--                      </form>-->
<!--                  </div>-->
<!--                  <?php endif; ?>-->
              </li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                      aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                      English
                      <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                      <li><a href="#">China</a></li>
                      <li><a href="#">English</a></li>
                  </ul>
              </li>
          </ul>

          <ul class="nav navbar-nav pull-right menu-list">
              <?php $__1FJNsRKg3T__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","cache"=>"0","condition"=>"1=isnav","row"=>"20"]); if(is_array($__1FJNsRKg3T__) || $__1FJNsRKg3T__ instanceof \think\Collection || $__1FJNsRKg3T__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__1FJNsRKg3T__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
              <li>
                  <a class="<?php if($nav->is_active): ?>active<?php endif; ?>" <?php if($nav['href'] == 0): ?>href="<?php echo $nav['url']; ?>"<?php endif; if($nav['target'] == 1): ?>target="_blank"<?php endif; ?>><?php echo $nav['name']; ?></a>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__1FJNsRKg3T__; ?>
<!--              <li class="active"><a href="<?php echo url('index/index/index'); ?>">HOME</a></li>-->
<!--              <li><a href="{<?php echo url('index/about/index'); ?>}">ABOUT US</a></li>-->
<!--              <li><a href="<?php echo url('index/product/list'); ?>">PRODUCT</a></li>-->
<!--              <li><a href="<?php echo url('index/news/index'); ?>">NEWS</a></li>-->
<!--              <li><a href="<?php echo url('index/contact/index'); ?>">CONTACT US</a></li>-->
          </ul>
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script>
    (function() {
        setTimeout(() => {
            var $banner = document.querySelector('#header-banner')
            var $navbar = document.querySelector('#page-navbar')
            var height = $banner.clientHeight
            var timeStamp = 0
            updateBackgroundColor()

            window.onscroll = function(e) {
                if (e.timeStamp - timeStamp >= 200) {
                    timeStamp = e.timeStamp
                    updateBackgroundColor()
                }
            }

            function updateBackgroundColor() {
                var isOver = document.documentElement.scrollTop > height
                $navbar.classList[isOver ? 'add' : 'remove']('is-over')
            }
        }, 2000)

    })()
</script>
<div id="header-banner" class="product-header">
    <div class="container relative" style="height: 100%;">
        <div class="product-header-content">
            <p class="title font-bold">PRODUCT CENTER</p>
            <div>
                <span class="glyphicon glyphicon-home"></span>
                <span>Home</span>
                »
                <span>Product Center</span>
            </div>
        </div>
    </div>
</div>


<main id="product-detail-body">
    <div class="part-of-main-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="padding-right: 50px;">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="big-img-wrap"><img src="<?php echo $__ARCHIVES__['image']; ?>" alt="product"></div>
                        </div>
                        <?php if(!(empty($__ARCHIVES__['images']) || (($__ARCHIVES__['images'] instanceof \think\Collection || $__ARCHIVES__['images'] instanceof \think\Paginator ) && $__ARCHIVES__['images']->isEmpty()))): ?>
                        <div class="col-md-3 d-flex small-img-wrap">
                            <?php if(is_array(explode(',',$__ARCHIVES__['images'])) || explode(',',$__ARCHIVES__['images']) instanceof \think\Collection || explode(',',$__ARCHIVES__['images']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$__ARCHIVES__['images']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?>
                                <div><img src="<?php echo cdnurl($image); ?>"></div>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6" style="padding-left: 50px;">
                    <div class="product-name">
                        <span class="f22 font-bold mr-4 title">Fire Robot</span>
                        <span>Model: <?php echo $__ARCHIVES__['model']; ?></span>
                    </div>
                    <p class="mt-2 mb-4 f12"><?php echo $__ARCHIVES__['description']; ?></p>
                    <p class="font-bold f12 mb-1">Main Specifications</p>
                    <?php echo $__ARCHIVES__['content']; ?>
<!--                    <table class="table table-bordered">-->
<!--                        <colgroup>-->
<!--                            <col width="60%">-->
<!--                            <col width="40%">-->
<!--                        </colgroup>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td>Maximum driving speed</td>-->
<!--                            <td>6km/h</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>Maximum driving speed</td>-->
<!--                            <td>6km/h</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>Maximum driving speed</td>-->
<!--                            <td>6km/h</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>Maximum driving speed</td>-->
<!--                            <td>6km/h</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>Maximum driving speed</td>-->
<!--                            <td>6km/h</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>Maximum driving speed</td>-->
<!--                            <td>6km/h</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>Maximum driving speed</td>-->
<!--                            <td>6km/h</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>Maximum driving speed</td>-->
<!--                            <td>6km/h</td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
                </div>
            </div>
            <?php if(!(empty($__ARCHIVES__['tedian']) || (($__ARCHIVES__['tedian'] instanceof \think\Collection || $__ARCHIVES__['tedian'] instanceof \think\Paginator ) && $__ARCHIVES__['tedian']->isEmpty()))): ?>
            <?php echo $__ARCHIVES__['tedian']; ?>

<!--            <div class="product-function-item">-->
<!--                <span class="icon mr-2 mt-1 glyphicon glyphicon-triangle-right"></span>-->
<!--                <div>-->
<!--                    <p class="title mb-2 font-bold">fire life detection and dangerous goods detection</p>-->
<!--                    <div class="item-content">-->
<!--                        Remote operation by personal, instead of manually entering the fire scene for investigation and detection, obtaining information such as life.-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="product-function-item">-->
<!--                <span class="icon mr-2 mt-1 glyphicon glyphicon-triangle-right"></span>-->
<!--                <div>-->
<!--                    <p class="title mb-2 font-bold">fire life detection and dangerous goods detection</p>-->
<!--                    <div class="item-content">-->
<!--                        Remote operation by personal, instead of manually entering the fire scene for investigation and detection, obtaining information such as lif characteristics and dangerous Remote operation by personal, instead of manually entering the fire scene for investigation and detection, obtaining information such as lif characteristics and dangerous Remote operation by personal, instead of manually entering the fire scene for dangerous.-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="product-function-item">-->
<!--                <span class="icon mr-2 mt-1 glyphicon glyphicon-triangle-right"></span>-->
<!--                <div>-->
<!--                    <p class="title mb-2 font-bold">fire life detection and dangerous goods detection</p>-->
<!--                    <div class="item-content">-->
<!--                        Remote operation by personal, instead of manually entering the fire scene for investigation and detection, obtaining information such as lif  personal, instead of manually entering the fire scene for investigation and detection, obtaining information such as lif characteristics and dangerous.-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <?php endif; ?>


            <div class="row">
                <div class="col-md-6" style="padding-right: 50px;">
                    <p class="font-bold f12 mb-1 title">List of main parts</p>
                    <?php echo $__ARCHIVES__['Introduction']; ?>
<!--                    <table class="table table-bordered">-->
<!--                        <colgroup>-->
<!--                            <col width="20%">-->
<!--                            <col width="30%">-->
<!--                            <col width="25%">-->
<!--                            <col width="25%">-->
<!--                        </colgroup>-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th>No.</th>-->
<!--                            <th>Part Name</th>-->
<!--                            <th>Quantity</th>-->
<!--                            <th>Channel</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td>1</td>-->
<!--                            <td>body</td>-->
<!--                            <td>1</td>-->
<!--                            <td>Homegrown</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>2</td>-->
<!--                            <td>body</td>-->
<!--                            <td>1</td>-->
<!--                            <td>Homegrown</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>3</td>-->
<!--                            <td>body</td>-->
<!--                            <td>1</td>-->
<!--                            <td>Homegrown</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>4</td>-->
<!--                            <td>body</td>-->
<!--                            <td>1</td>-->
<!--                            <td>Homegrown</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>5</td>-->
<!--                            <td>body</td>-->
<!--                            <td>1</td>-->
<!--                            <td>Homegrown</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>6</td>-->
<!--                            <td>body</td>-->
<!--                            <td>1</td>-->
<!--                            <td>Homegrown</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>7</td>-->
<!--                            <td>body</td>-->
<!--                            <td>1</td>-->
<!--                            <td>Homegrown</td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td>8</td>-->
<!--                            <td>body</td>-->
<!--                            <td>1</td>-->
<!--                            <td>Homegrown</td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
                </div>
                <?php if(!(empty($__ARCHIVES__['use']) || (($__ARCHIVES__['use'] instanceof \think\Collection || $__ARCHIVES__['use'] instanceof \think\Paginator ) && $__ARCHIVES__['use']->isEmpty()))): ?>
                <div class="col-md-6" style="padding-left: 50px;">
                    <p class="font-bold f12 mb-2 title">Conditions of Use</p>
                    <div class="conditions-list pl-2">
                        <?php echo $__ARCHIVES__['use']; ?>
<!--                        <p>(1) Robot changing power supply: 220VAC, 400w</p>-->
<!--                        <p>(2) Changing conditions: 29.4V, 5A</p>-->
<!--                        <p>(3) Working temperature: 20 ~ +55</p>-->
<!--                        <p>(4) Working humidity: < 95%</p>-->
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if(!(empty($__ARCHIVES__['video']) || (($__ARCHIVES__['video'] instanceof \think\Collection || $__ARCHIVES__['video'] instanceof \think\Paginator ) && $__ARCHIVES__['video']->isEmpty()))): ?>
    <div class="part-of-video-wrap">
        <div class="container text-center">
<!--            <video class="video" poster="" src="/assets/qianzhi/frontend/product/detail/mlxg.mp4" controls="controls" controlsList="nodownload">-->
<!--                您的浏览器不支持 video 标签。-->
<!--            </video>-->
            <video class="video" poster="" src="<?php echo $__ARCHIVES__['video']; ?>" controls="controls" controlsList="nodownload">
                您的浏览器不支持 video 标签。
            </video>
        </div>
    </div>
    <?php endif; if(!(empty($__ARCHIVES__['images']) || (($__ARCHIVES__['images'] instanceof \think\Collection || $__ARCHIVES__['images'] instanceof \think\Paginator ) && $__ARCHIVES__['images']->isEmpty()))): ?>
    <div class="part-of-appearance">
        <div class="container">
            <div class="title font-bold f30 text-center">Appearance design drawing</div>
            <div class="row">
                <?php if(is_array(explode(',',$__ARCHIVES__['images'])) || explode(',',$__ARCHIVES__['images']) instanceof \think\Collection || explode(',',$__ARCHIVES__['images']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$__ARCHIVES__['images']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?>
                <div class="col-md-4">
                    <div class="img-wrap">
                        <img src="<?php echo cdnurl($image); ?>" alt="product">
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</main>

<link rel="stylesheet" href="/assets/qianzhi/frontend/common/footer/footer.css">

<footer>
  <div class="contact-us">
    <div class="container">
      <div class="row">
        <div class="col-md-8 f28">
          YOUR ARE WELCOME TO CONTACT US
        </div>
        <div class="col-md-4 text-right">
          <button class="btn"><a href="/ABOUTUS.html">CONTACT US</a></button>
        </div>
      </div>
    </div>
  </div>
  <div class="page-footer">
    <div class="footer-info">
      <div class="container">
        <div class="row d-flex" style="flex-wrap: wrap;">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <span class="title">Contact Information</span>
            <?php $__eqHzY4MFxd__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"contact-qianzhi","orderby"=>"id","orderway"=>"asc"]); if(is_array($__eqHzY4MFxd__) || $__eqHzY4MFxd__ instanceof \think\Collection || $__eqHzY4MFxd__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__eqHzY4MFxd__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;if($block['id'] != 54): ?>
            <p class="zh-list">
              <span class="icon glyphicon glyphicon-<?php echo $block['image']; ?>"></span>
              <span><?php echo str_replace(["<p>","</p>"], "", $block['content']); ?></span>
            </p>
            <?php endif; endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__eqHzY4MFxd__; ?>

          </div>
          <div class="col-md-2 col-sm-6 col-xs-12">
            <span class="title">Product</span>
            <?php $__udvto3NpB1__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","type"=>"son","typeid"=>"44","condition"=>"1=cpindex","orderby"=>"weigh","orderway"=>"asc"]); if(is_array($__udvto3NpB1__) || $__udvto3NpB1__ instanceof \think\Collection || $__udvto3NpB1__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__udvto3NpB1__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>
              <p><?php echo $channel['name']; ?></p>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__udvto3NpB1__; ?>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <span class="title">Recent post</span>
            <?php $__AecpYxRS98__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","flag"=>"index","model"=>"10","row"=>"10","orderby"=>"updatetime","addon"=>"content"]); if(is_array($__AecpYxRS98__) || $__AecpYxRS98__ instanceof \think\Collection || $__AecpYxRS98__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__AecpYxRS98__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
              <p>
              <div class="media">
                <div class="media-left">
                  <di>
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                  </di>
                </div>
                <div class="media-body">
                  <span class="media-heading"><?php echo $item['title']; ?></span>
                  <span class="date"><?php echo date('Y-m-d', $item['publishtime']); ?></span>
                </div>
              </div>
              </p>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__AecpYxRS98__; ?>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <span class="title">Contact Form</span>
            <form class="contact-from">
              <div class="form-group">
                <label class="sr-only" for="name">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name">
              </div>
              <div class="form-group">
                <label class="sr-only" for="country">Country</label>
                <input type="text" class="form-control" id="country" placeholder="Country">
              </div>
              <div class="form-group">
                <label class="sr-only" for="email"></label>
                <input type="email" class="form-control" id="email" placeholder="Email">
              </div>
              <div class="form-group">
                <label class="sr-only" for="message"></label>
                <textarea class="form-control" id="message" placeholder="Message"></textarea>
              </div>
              <button type="submit" class="btn btn-info full-width">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        <div class="row">
          <div class="col-md-7 col-sm-6">
            <img style="vertical-align: bottom;" src="/assets/qianzhi/frontend/common/footer/icon-footer-logo.png" alt="logo">
            Copyright: Huan Qianzhi Robot Technology Development Co,. Ltd
          </div>
          <div class="col-md-5 col-sm-6 text-right communications">
            <?php $__5cfh3JxTWl__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"mt","orderby"=>"weigh","orderway"=>"asc"]); if(is_array($__5cfh3JxTWl__) || $__5cfh3JxTWl__ instanceof \think\Collection || $__5cfh3JxTWl__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__5cfh3JxTWl__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo $block['url']; ?>" title="<?php echo $block['title']; ?>" target="_blank">
              <img src="<?php echo $block['image']; ?>" alt="logo">
<!--              <i class="ico <?php echo $block['image']; ?>"></i>-->
            </a>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__5cfh3JxTWl__; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<script
        data-main="/assets/qianzhi/frontend/product/detail/detail.js"
        src="/assets/qianzhi/require.min.js"
>
</script>

</body>

</html>