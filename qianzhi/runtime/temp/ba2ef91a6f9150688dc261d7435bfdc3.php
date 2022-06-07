<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/index-qianzhi.html";i:1654608012;s:82:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/meta.html";i:1654271884;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/header.html";i:1654618545;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/footer.html";i:1654524000;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/script.html";i:1654003873;}*/ ?>
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
    <link rel="stylesheet" href="/assets/qianzhi/frontend/home/home.css">
</head>

<body class="home-wrap">
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
                  <?php if(in_array(($site['sousuo']), explode(',',"1"))): ?>
                  <form class="navbar-form navbar-left" id="js-search-from" action="/s.html" method="post">
                      <div class="form-group">
                          <input type="text" class="form-control search-input" id="js-search-input"
                                 data-suggestion-url="/addons/cms/search/suggestion.html" placeholder="Search" />
                      </div>
                      <botton class="glyphicon glyphicon-search media-middle cursor-pointer" id="js-search-btn"
                          aria-label="search button" aria-hidden="true">
                      </botton>
                  </form>
                  <?php endif; ?>
<!--                  <form class="navbar-form navbar-left" id="js-search-from">-->
<!--                      <div class="form-group">-->
<!--                          <input type="text" class="form-control search-input" id="js-search-input"-->
<!--                                 placeholder="Search" />-->
<!--                      </div>-->
<!--                      <span class="glyphicon glyphicon-search media-middle cursor-pointer" id="js-search-btn"-->
<!--                            aria-label="search button" aria-hidden="true">-->
<!--                      </span>-->
<!--                  </form>-->
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
              <?php $__uagFxkyYE7__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","cache"=>"0","condition"=>"1=isnav","row"=>"20"]); if(is_array($__uagFxkyYE7__) || $__uagFxkyYE7__ instanceof \think\Collection || $__uagFxkyYE7__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__uagFxkyYE7__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
              <li>
                  <a class="<?php if($nav->is_active): ?>active<?php endif; ?>" <?php if($nav['href'] == 0): ?>href="<?php echo $nav['url']; ?>"<?php endif; if($nav['target'] == 1): ?>target="_blank"<?php endif; ?>><?php echo $nav['name']; ?></a>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__uagFxkyYE7__; ?>
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
<div id="header-banner" class="home-header">
    <div class="home-header-detail text-center">
        <span class="d-block top-title f18">BEST QUALITY SERVICE</span>
        <span class="d-block title f50 font-bold">QIANZHI ROBOT</span>
        <span class="d-block sub-title f28">Towards the goal of building a R&D heights of special robots in china</span>
        <div class="but-group">
            <a type="button" href="/" class="btn btn-info btn-lg mr-4">
                Learn More
            </a>
            <a type="button" href="/ABOUTUS.html" class="btn btn-danger btn-lg">
                Contact Us
            </a>
        </div>
    </div>
</div>


<main id="home-body">
    <!-- out product -->
    <div class="home-body-card our-product">
        <div class="container card-item">
            <div class="text-center">
                <span class="top-title">Our Products</span>
                <span class="title">BEST OF OUR WORKS</span>
            </div>
            <div class="row" id="ourProduct">
                <script id="ourProductTemplate" type="text/html">
                    <?php $__GgBcWJ593y__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","type"=>"son","typeid"=>"44","condition"=>"1=cpindex"]); if(is_array($__GgBcWJ593y__) || $__GgBcWJ593y__ instanceof \think\Collection || $__GgBcWJ593y__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__GgBcWJ593y__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;$__o1EF8tTeZM__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","flag"=>"index","row"=>"9","orderby"=>"updatetime","channel"=>$channel['id'],"addon"=>"content,bgimage"]); if(is_array($__o1EF8tTeZM__) || $__o1EF8tTeZM__ instanceof \think\Collection || $__o1EF8tTeZM__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__o1EF8tTeZM__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail content-item">
                            <div class="card-img-wrap">
                                <div class="card-img-wrap-bg"  style="background-image: url(<?php echo $item['bgimage']; ?>);">
                                </div>
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                            </div>
                            <div class="caption">
                                <p class="font-bold f20 mt-4"><?php echo $item['title']; ?></p>
<!--                                <p class="caption-content multiple-text-ellipsis"><?php echo str_replace(["<p>","</p>"], "", $item['content']); ?></p>-->
                                <p class="caption-content multiple-text-ellipsis"><?php echo $item['description']; ?></p>
                                <a href="<?php echo $item['url']; ?>" class="product-learn-more">
                                    Learn More
                                    <span class="glyphicon glyphicon-arrow-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__o1EF8tTeZM__; endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__GgBcWJ593y__; ?>
                </script>
            </div>
        </div>
    </div>

    <!-- about us -->
    <div class="home-body-card about-us">
        <div class="container card-item">
            <div class="text-center">
                <span class="top-title">About Us</span>
                <?php $__n4OwaZcF0M__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"aboutsTop","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__n4OwaZcF0M__) || $__n4OwaZcF0M__ instanceof \think\Collection || $__n4OwaZcF0M__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__n4OwaZcF0M__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                    <span class="title f28 mb-4"><?php echo $block['title']; ?></span>
                    <span class="sub-title"><?php echo str_replace(["<p>","</p>"], "", $block['content']); ?></span>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__n4OwaZcF0M__; ?>
            </div>
            <div id="aboutUs">
                <script id="aboutUsTemplate" type="text/html">
                    <div class="row">
                        <?php $__jnfSqtwI3r__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"aboutsTop","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__jnfSqtwI3r__) || $__jnfSqtwI3r__ instanceof \think\Collection || $__jnfSqtwI3r__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__jnfSqtwI3r__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;if(!(empty($block['images']) || (($block['images'] instanceof \think\Collection || $block['images'] instanceof \think\Paginator ) && $block['images']->isEmpty()))): if(is_array(explode(',',$block['images'])) || explode(',',$block['images']) instanceof \think\Collection || explode(',',$block['images']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$block['images']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?>
                        <div class="text-center col-md-{{setCol(<?php echo $key; ?>)}} mt-4">
                            <span class="about-item-title f20 font-bold"><?php echo $block['intro'][$key]['info']; ?></span>
                            <p class="about-item-sub-title f14"><?php echo $block['intro'][$key]['txt']; ?></p>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__jnfSqtwI3r__; ?>
                    </div>
                    <div class="row d-flex about-us-content">
                        <div class="col-md-8 about-us-list">
                            <div id="about-us-carousel" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <?php $__VzE246snWg__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"aboutsFoot","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__VzE246snWg__) || $__VzE246snWg__ instanceof \think\Collection || $__VzE246snWg__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__VzE246snWg__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;if(!(empty($block['images']) || (($block['images'] instanceof \think\Collection || $block['images'] instanceof \think\Paginator ) && $block['images']->isEmpty()))): if(is_array(explode(',',$block['images'])) || explode(',',$block['images']) instanceof \think\Collection || explode(',',$block['images']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$block['images']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?>
                                    <div class="item {{setDefaultActive(<?php echo $key; ?>)}}">
                                        <img src="<?php echo $image; ?>" alt="about us">
                                        <div class="carousel-caption">
                                            <span class="f30"><?php echo $block['intro'][$key]['info']; ?></span>
                                            <span><?php echo $block['intro'][$key]['txt']; ?></span>
                                        </div>
                                    </div>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__VzE246snWg__; ?>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 about-us-list right d-flex">
                            <?php $__A27vslKbJT__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"aboutsMid","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__A27vslKbJT__) || $__A27vslKbJT__ instanceof \think\Collection || $__A27vslKbJT__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__A27vslKbJT__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                            <div>
                                <img src="<?php echo $block['image']; ?>" alt="<?php echo $block['title']; ?>">
                                <span class="font-bold"><?php echo $block['title']; ?></span>
                            </div>
                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__A27vslKbJT__; ?>
                        </div>
                    </div>
                </script>
            </div>
        </div>
    </div>

    <!-- strategic partners -->
    <div class="home-body-card strategic-partners">
        <div class="container">
            <?php $__5YLWJj1TnC__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"hezuo","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__5YLWJj1TnC__) || $__5YLWJj1TnC__ instanceof \think\Collection || $__5YLWJj1TnC__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__5YLWJj1TnC__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
            <div class="text-center">
                <span class="title font-bold"><?php echo $block['title']; ?></span>
                <hr />
            </div>
            <div class="row" id="strategicPartners">
                <script id="strategicPartnersTemplate" type="text/html">
                    <?php if(!(empty($block['images']) || (($block['images'] instanceof \think\Collection || $block['images'] instanceof \think\Paginator ) && $block['images']->isEmpty()))): if(is_array(explode(',',$block['images'])) || explode(',',$block['images']) instanceof \think\Collection || explode(',',$block['images']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$block['images']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?>
                    <div class="item col-sm-4 col-md-3">
                        <div href="#" class="thumbnail p-0">
                            <img src="<?php echo $image; ?>" alt="partners">
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </script>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__5YLWJj1TnC__; ?>
        </div>
    </div>

    <!-- news center -->
    <div class="home-body-card news-center">
        <div class="container card-item">
            <div class="text-center">
                <span class="top-title">News Center</span>
                <span class="title">Lastest News</span>
            </div>
            <div class="row" id="newsCenter">
                <script id="newsCenterTemplate" type="text/html">
                    <?php $__JWUhemfbG9__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","flag"=>"index","model"=>"10","row"=>"3","orderby"=>"updatetime","addon"=>"content"]); if(is_array($__JWUhemfbG9__) || $__JWUhemfbG9__ instanceof \think\Collection || $__JWUhemfbG9__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__JWUhemfbG9__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                    <div class="item col-sm-6 col-md-4">
                        <div class="thumbnail content-item news-content-item">
                            <div class="card-img-wrap">
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                            </div>
                            <div class="caption">
                                <p class="font-bold f14 mt-2 text-ellipsis"><?php echo $item['title']; ?></p>
                                <p class="caption-content multiple-text-ellipsis mt-2"><?php echo str_replace(["<p>","</p>"], "", $item['content']); ?></p>
                                <p class="news-date text-right f12">
                                    <span class="d-iblock"><?php echo date('Y-m-d', $item['updatetime']); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__JWUhemfbG9__; ?>
                </script>
            </div>
        </div>
    </div>
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
            <?php $__UwZ95fiHNL__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"contact-qianzhi","orderby"=>"id","orderway"=>"asc"]); if(is_array($__UwZ95fiHNL__) || $__UwZ95fiHNL__ instanceof \think\Collection || $__UwZ95fiHNL__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__UwZ95fiHNL__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;if($block['id'] != 54): ?>
            <p class="zh-list">
              <span class="icon glyphicon glyphicon-<?php echo $block['image']; ?>"></span>
              <span><?php echo str_replace(["<p>","</p>"], "", $block['content']); ?></span>
            </p>
            <?php endif; endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__UwZ95fiHNL__; ?>

          </div>
          <div class="col-md-2 col-sm-6 col-xs-12">
            <span class="title">Product</span>
            <?php $__qC6py5EkB9__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","type"=>"son","typeid"=>"44","condition"=>"1=cpindex","orderby"=>"weigh","orderway"=>"asc"]); if(is_array($__qC6py5EkB9__) || $__qC6py5EkB9__ instanceof \think\Collection || $__qC6py5EkB9__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__qC6py5EkB9__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>
              <p><?php echo $channel['name']; ?></p>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__qC6py5EkB9__; ?>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <span class="title">Recent post</span>
            <?php $__hdmv1SciYb__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","flag"=>"index","model"=>"10","row"=>"10","orderby"=>"updatetime","addon"=>"content"]); if(is_array($__hdmv1SciYb__) || $__hdmv1SciYb__ instanceof \think\Collection || $__hdmv1SciYb__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__hdmv1SciYb__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
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
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__hdmv1SciYb__; ?>
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
            <?php $__i9Vth1kmNO__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"mt","orderby"=>"weigh","orderway"=>"asc"]); if(is_array($__i9Vth1kmNO__) || $__i9Vth1kmNO__ instanceof \think\Collection || $__i9Vth1kmNO__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__i9Vth1kmNO__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo $block['url']; ?>" title="<?php echo $block['title']; ?>" target="_blank">
              <img src="<?php echo $block['image']; ?>" alt="logo">
<!--              <i class="ico <?php echo $block['image']; ?>"></i>-->
            </a>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__i9Vth1kmNO__; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<script
        data-main="/assets/qianzhi/frontend/home/home.js"
        src="/assets/qianzhi/require.min.js"
>
</script>

</body>

</html>