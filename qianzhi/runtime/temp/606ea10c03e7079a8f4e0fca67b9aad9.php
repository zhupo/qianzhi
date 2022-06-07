<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:83:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/list_product.html";i:1654608097;s:82:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/meta.html";i:1654271884;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/header.html";i:1654618749;s:81:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/mbx.html";i:1654444202;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/footer.html";i:1654524000;s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/script.html";i:1654003873;}*/ ?>

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
	<link rel="stylesheet" href="/assets/qianzhi/frontend/product/list/list.css">
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
                  <?php if(in_array(($site['sousuo']), explode(',',"1"))): ?>
                  <form class="navbar-form navbar-left" id="js-search-from" action="/s.html" method="post">
                      <div class="form-group">
                          <input type="text" class="form-control search-input" id="js-search-input"
                                 data-suggestion-url="/addons/cms/search/suggestion.html" placeholder="Search" />
                      </div>
                      <button class="glyphicon glyphicon-search media-middle cursor-pointer" id="js-search-btn"
                          aria-label="search button" aria-hidden="true">
                      </button>
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
              <?php $__SNnAJQqO6R__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","cache"=>"0","condition"=>"1=isnav","row"=>"20"]); if(is_array($__SNnAJQqO6R__) || $__SNnAJQqO6R__ instanceof \think\Collection || $__SNnAJQqO6R__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__SNnAJQqO6R__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
              <li>
                  <a class="<?php if($nav->is_active): ?>active<?php endif; ?>" <?php if($nav['href'] == 0): ?>href="<?php echo $nav['url']; ?>"<?php endif; if($nav['target'] == 1): ?>target="_blank"<?php endif; ?>><?php echo $nav['name']; ?></a>
              </li>
              <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__SNnAJQqO6R__; ?>
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
<div class="lanmubanner qc">
    <img src="<?php echo $__CHANNEL__['image']; ?>" alt="<?php echo $__CHANNEL__['name']; ?>">
 	<div class="lanmubannerTxt">
		 	<div class="box">
		 		<h2><?php echo $__CHANNEL__['name']; ?></h2>
		 		    
                  
                        <div class="Breadcrumbs">
							<span class="glyphicon glyphicon-home"></span>
                        <?php $__j7QCqlwFz5__ = \addons\cms\model\Channel::getBreadcrumb($__CHANNEL__??[], $__ARCHIVES__??[], $__TAGS__??[], $__PAGE__??[], $__DIYFORM__??[]); if(is_array($__j7QCqlwFz5__) || $__j7QCqlwFz5__ instanceof \think\Collection || $__j7QCqlwFz5__ instanceof \think\Paginator): $k = 0; $__LIST__ = $__j7QCqlwFz5__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;if($k>1): ?>» <?php endif; ?><a title="<?php echo $item['name']; ?>" href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>
        				<?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__j7QCqlwFz5__; ?>
        				</div>
                 
                    
		 	</div>
	</div>
</div>

<!--<div id="header-banner" class="product-header">-->
<!--	<div class="container relative" style="height: 100%;">-->
<!--		<div class="product-header-content">-->
<!--			<p class="title font-bold">PRODUCT CENTER</p>-->
<!--			<div>-->
<!--				<span class="glyphicon glyphicon-home"></span>-->
<!--				<span>Home</span>-->
<!--				»-->
<!--				<span>Product Center</span>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->


<main id="product-list-body">
	<div class="container card-item">
		<div class="row" id="productList">
			<script id="productListTemplate" type="text/html">
				<?php $__1EMGF3PX4t__ = $__PAGELIST__; if(is_array($__1EMGF3PX4t__) || $__1EMGF3PX4t__ instanceof \think\Collection || $__1EMGF3PX4t__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__1EMGF3PX4t__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
				<div class="col-sm-6 col-md-4">
					<a href="<?php echo $item['url']; ?>"  title="<?php echo $item['title']; ?>">
					<div class="thumbnail content-item">
						<div class="card-img-wrap">
							<img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
						</div>
						<div class="caption">
							<p class="font-bold f20 mt-3"><?php echo $item['title']; ?></p>
							<p class="caption-content multiple-text-ellipsis"><?php echo $item['description']; ?></p>
						</div>
					</div>
					</a>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__1EMGF3PX4t__; ?>
			</script>
		</div>
		<nav aria-label="Product list pagination" class="text-center nav-pagination">
			<?php echo $__PAGELIST__->render(["type"=>"full"]); ?>
		</nav>
<!--		<div class="Pagination">-->
<!--			<?php echo $__PAGELIST__->render(["type"=>"full"]); ?>-->
<!--		</div>-->
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
            <?php $__Ql6GBaTsMJ__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"contact-qianzhi","orderby"=>"id","orderway"=>"asc"]); if(is_array($__Ql6GBaTsMJ__) || $__Ql6GBaTsMJ__ instanceof \think\Collection || $__Ql6GBaTsMJ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Ql6GBaTsMJ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;if($block['id'] != 54): ?>
            <p class="zh-list">
              <span class="icon glyphicon glyphicon-<?php echo $block['image']; ?>"></span>
              <span><?php echo str_replace(["<p>","</p>"], "", $block['content']); ?></span>
            </p>
            <?php endif; endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__Ql6GBaTsMJ__; ?>

          </div>
          <div class="col-md-2 col-sm-6 col-xs-12">
            <span class="title">Product</span>
            <?php $__l028sJB4gH__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","type"=>"son","typeid"=>"44","condition"=>"1=cpindex","orderby"=>"weigh","orderway"=>"asc"]); if(is_array($__l028sJB4gH__) || $__l028sJB4gH__ instanceof \think\Collection || $__l028sJB4gH__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__l028sJB4gH__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>
              <p><?php echo $channel['name']; ?></p>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__l028sJB4gH__; ?>
          </div>
          <div class="col-md-4 col-sm-6 col-xs-12">
            <span class="title">Recent post</span>
            <?php $__vs4DTg6hjK__ = \addons\cms\model\Archives::getArchivesList(["id"=>"item","flag"=>"index","model"=>"10","row"=>"10","orderby"=>"updatetime","addon"=>"content"]); if(is_array($__vs4DTg6hjK__) || $__vs4DTg6hjK__ instanceof \think\Collection || $__vs4DTg6hjK__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__vs4DTg6hjK__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
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
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__vs4DTg6hjK__; ?>
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
            <?php $__G8oVenAUst__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"mt","orderby"=>"weigh","orderway"=>"asc"]); if(is_array($__G8oVenAUst__) || $__G8oVenAUst__ instanceof \think\Collection || $__G8oVenAUst__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__G8oVenAUst__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
            <a href="<?php echo $block['url']; ?>" title="<?php echo $block['title']; ?>" target="_blank">
              <img src="<?php echo $block['image']; ?>" alt="logo">
<!--              <i class="ico <?php echo $block['image']; ?>"></i>-->
            </a>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__G8oVenAUst__; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<script
		data-main="/assets/qianzhi/frontend/product/list/list.js"
		src="/assets/qianzhi/require.min.js"
>
</script>

</body>

</html>
