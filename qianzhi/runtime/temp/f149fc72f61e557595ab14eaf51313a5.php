<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/channel_about.html";i:1653808619;s:81:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/top.html";i:1654359903;s:81:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/mbx.html";i:1654444202;s:82:"/Users/panliu/Documents/project/zjs-copy/addons/cms/view/default1/common/foot.html";i:1654359903;}*/ ?>
<!--<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0,maximum-scale=1.0">
<?php if(empty($__CHANNEL__) AND empty($__ARCHIVES__) AND empty($__PAGE__)): ?>
<title><?php echo $site['name']; ?></title>
<meta name="keywords" content="<?php echo $site['keywords']; ?>" />
<meta name="description" content="<?php echo $site['description']; ?>" />
<?php else: ?>
<title><?php echo \think\Config::get("cms.title"); ?>-<?php echo $site['name']; ?></title>
<meta name="keywords" content="<?php echo \think\Config::get("cms.keywords"); ?>" />
<meta name="description" content="<?php echo \think\Config::get("cms.description"); ?>" />
<?php endif; ?>
<!-- link -->
<link rel="stylesheet" type="text/css" href="https://at.alicdn.com/t/font_601403_l9mrrofm0m.css">
<link rel="stylesheet" type="text/css" href="https:<?php echo $site['ico']; ?>">
<link rel="stylesheet" ype="text/css" href="/template/default1/css/common.css?v=<?php echo $site['version']; ?>">
<link rel="stylesheet" type="text/css"media="screen and (min-width:1280px)" href="/template/default1/css/pc.css?v=<?php echo $site['version']; ?>">
<link rel="stylesheet" type="text/css" media="screen and (max-width:1279px)" href="/template/default1/css/wap.css?v=<?php echo $site['version']; ?>">
<!-- link -->
<!-- script -->
<script type="text/javascript" src="/template/default1/js/jquery.js?v=<?php echo $site['version']; ?>"></script>
<script type="text/javascript" src="/template/default1/js/img.js?v=<?php echo $site['version']; ?>"></script>
<script type="text/javascript" src="/template/default1/js/easyzoom.js?v=<?php echo $site['version']; ?>"></script>
<script type="text/javascript" src="/template/default1/js/swiper.js?v=<?php echo $site['version']; ?>"></script>
<!-- script -->
</head>
<body class="<?php if($_SERVER['REQUEST_URI'] != '/'): ?>content<?php endif; ?>">
<?php switch($site['head']): case "1": ?>
<div class="indexNav" id="indexNav">
     <div class="indexheadbj">
        <div class="box indexhead">
                <div class="indexheadL">Welcome to <?php echo $site['name']; ?></div>
                <div class="indexheaR">
               <?php $__hJWjYD8i47__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"contact","orderby"=>"weigh","orderway"=>"desc","condition"=>"1=foottop"]); if(is_array($__hJWjYD8i47__) || $__hJWjYD8i47__ instanceof \think\Collection || $__hJWjYD8i47__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__hJWjYD8i47__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                    <p><a href="<?php echo $block['url']; ?>" title=""><?php echo $block['title']; ?> : <?php echo str_replace(["<p>","</p>"], "", $block['content']); ?></a></p>
               <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__hJWjYD8i47__; ?>
               </div>
        </div>
    </div>

    <div class="indexNavNr box">
     	<a class="logo" href="/">
    	<?php if(empty($site['logotxt']) || (($site['logotxt'] instanceof \think\Collection || $site['logotxt'] instanceof \think\Paginator ) && $site['logotxt']->isEmpty())): ?>
        <img class="logo1" src="<?php echo $site['logo']; ?>">
        <img class="logo2" src="<?php echo $site['logo2']; ?>">
    	<?php else: ?>
            <h1><?php echo $site['logotxt']; ?></h1>
    	<?php endif; ?>
    	</a>

        <div class="indexNavNrRight">
        <div class="navA">
            <ul class="qc" id="nav">
            <?php $__4ycLEFwaHg__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","cache"=>"0","condition"=>"1=isnav","row"=>"20"]); if(is_array($__4ycLEFwaHg__) || $__4ycLEFwaHg__ instanceof \think\Collection || $__4ycLEFwaHg__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__4ycLEFwaHg__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
                <li>
                    <a class="<?php if($nav->is_active): ?>this<?php endif; ?>" <?php if($nav['href'] == 0): ?>href="<?php echo $nav['url']; ?>"<?php endif; if($nav['target'] == 1): ?>target="_blank"<?php endif; ?>><?php echo $nav['name']; ?></a>
                    <?php if($nav['has_child']): ?>
                    <ul>

                        <?php $__QW1vGBc7Kj__ = \addons\cms\model\Archives::getArchivesList(["id"=>"navshow","channel"=>$nav['id'],"orderby"=>"weigh","orderway"=>"desc","flag"=>"top","row"=>"20"]); if(is_array($__QW1vGBc7Kj__) || $__QW1vGBc7Kj__ instanceof \think\Collection || $__QW1vGBc7Kj__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__QW1vGBc7Kj__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navshow): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo $navshow['url']; ?>" title="<?php echo $navshow['title']; ?>"><?php echo $navshow['title']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__QW1vGBc7Kj__; $__uvPED2V9HU__ = \addons\cms\model\Channel::getChannelList(["id"=>"son","type"=>"son","condition"=>"1=isnav","typeid"=>$nav['id'],"cache"=>"0","row"=>"20"]); if(is_array($__uvPED2V9HU__) || $__uvPED2V9HU__ instanceof \think\Collection || $__uvPED2V9HU__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__uvPED2V9HU__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($i % 2 );++$i;?>

                            <li><a class="<?php if($son->is_active): ?>this<?php endif; ?>"  href="<?php echo $son['url']; ?>"><?php echo $son['name']; ?></a>
                                 <?php if($son['has_child']): ?>
                                 <ul>
                                    <?php $__dVsWgakzv6__ = \addons\cms\model\Channel::getChannelList(["id"=>"sons","condition"=>"1=isnav","type"=>"son","typeid"=>$son['id'],"cache"=>"0"]); if(is_array($__dVsWgakzv6__) || $__dVsWgakzv6__ instanceof \think\Collection || $__dVsWgakzv6__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__dVsWgakzv6__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sons): $mod = ($i % 2 );++$i;?>
                                    <li><a class="<?php if($sons->is_active): ?>this<?php endif; ?>"  href="<?php echo $sons['url']; ?>"><?php echo $sons['name']; ?></a></li>
                                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__dVsWgakzv6__; ?>
                                </ul>
                                <?php endif; ?>
                            </li>

                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__uvPED2V9HU__; ?>
                    </ul>
                    <?php else: ?>
                    <ul>
                        <?php $__EIjsdOT0BJ__ = \addons\cms\model\Archives::getArchivesList(["id"=>"navshow","channel"=>$nav['id'],"orderby"=>"weigh","orderway"=>"desc","flag"=>"top"]); if(is_array($__EIjsdOT0BJ__) || $__EIjsdOT0BJ__ instanceof \think\Collection || $__EIjsdOT0BJ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__EIjsdOT0BJ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navshow): $mod = ($i % 2 );++$i;?>
                        <li><a href="<?php echo $navshow['url']; ?>" title="<?php echo $navshow['title']; ?>"><?php echo $navshow['title']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__EIjsdOT0BJ__; ?>
                    </ul>
                   <?php endif; ?>
               </li>
            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__4ycLEFwaHg__; ?>
            </ul>
        </div>

        <?php if(in_array(($site['indexcp']), explode(',',"1"))): ?>
        <a class="CartIco" href="/Cart.html"><i class="ico icon-gouwuche"></i><em>0</em></a>
        <?php endif; if(is_array($site['languages']) || $site['languages'] instanceof \think\Collection || $site['languages'] instanceof \think\Paginator): $i = 0; $__LIST__ = $site['languages'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
        <a class="RequestAQuote" href="<?php echo $item; ?>"> <?php echo $key; ?> <i class="ico icon-arrow-left-copy"></i></a>
        <?php endforeach; endif; else: echo "" ;endif; if(in_array(($site['sousuo']), explode(',',"1"))): ?>
        <div class="sousuoA">
              <form action="/s.html" method="post">
                <input autocomplete = "off" class="form-control" name="q" data-suggestion-url="/addons/cms/search/suggestion.html" type="text" value="" placeholder="Key words">
                <button class="ico icon-icon-test"></button>
            </form>
    	</div>
        <?php endif; ?>

       </div>
   </div>
</div>
<?php break; case "2": ?>
<div class="indexNavC" id="indexNav">
    <div class="headC box">
        <div class="headCNr">
            <a class="headCNrlogo" href="/">
            	<?php if(empty($site['logotxt']) || (($site['logotxt'] instanceof \think\Collection || $site['logotxt'] instanceof \think\Paginator ) && $site['logotxt']->isEmpty())): ?>
                <img class="logo1" src="<?php echo $site['logo']; ?>">
                <img class="logo2" src="<?php echo $site['logo2']; ?>">
            	<?php else: ?>
                    <h1><?php echo $site['logotxt']; ?></h1>
            	<?php endif; ?>
        	</a>
            <div class="headCRight">
                <a><span><i class="ico icon-1-03"></i></span><p><em>Working Days</em>Mon - Sat: 09:00 AM - 06:00 PM</p></a>
                <?php $__PCOGwFqdnb__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"contact","orderby"=>"weigh","orderway"=>"desc","condition"=>"1=foottop"]); if(is_array($__PCOGwFqdnb__) || $__PCOGwFqdnb__ instanceof \think\Collection || $__PCOGwFqdnb__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__PCOGwFqdnb__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
     		    <a><span><i class="ico <?php echo $block['image']; ?>"></i></span><p><em><?php echo $block['title']; ?></em><?php echo str_replace(["<p>","</p>"], "", $block['content']); ?></p></a>
     			<?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__PCOGwFqdnb__; ?>
            </div>
        </div>
    </div>


 <div class="indexNavNrC">
   <div class="box indexNavNrCBox">

    <ul class="qc" id="navC">
    <?php $__FyalefNAr5__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","cache"=>"0","condition"=>"1=isnav","row"=>"20"]); if(is_array($__FyalefNAr5__) || $__FyalefNAr5__ instanceof \think\Collection || $__FyalefNAr5__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__FyalefNAr5__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
        <li>
            <a class="<?php if($nav->is_active): ?>this<?php endif; ?>" href="<?php echo $nav['url']; ?>"><?php echo $nav['name']; ?></a>
            <?php if($nav['has_child']): ?>
            <ul>

                <?php $__oTCDutdL6G__ = \addons\cms\model\Archives::getArchivesList(["id"=>"navshow","channel"=>$nav['id'],"orderby"=>"weigh","orderway"=>"desc","flag"=>"top"]); if(is_array($__oTCDutdL6G__) || $__oTCDutdL6G__ instanceof \think\Collection || $__oTCDutdL6G__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__oTCDutdL6G__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navshow): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo $navshow['url']; ?>" title="<?php echo $navshow['title']; ?>"><?php echo $navshow['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__oTCDutdL6G__; $__Wewbp8tncX__ = \addons\cms\model\Channel::getChannelList(["id"=>"son","type"=>"son","condition"=>"1=isnav","typeid"=>$nav['id'],"cache"=>"0"]); if(is_array($__Wewbp8tncX__) || $__Wewbp8tncX__ instanceof \think\Collection || $__Wewbp8tncX__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Wewbp8tncX__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($i % 2 );++$i;?>

                    <li><a class="<?php if($son->is_active): ?>this<?php endif; ?>"  href="<?php echo $son['url']; ?>"><?php echo $son['name']; ?></a>
                         <?php if($son['has_child']): ?>
                         <ul>
                            <?php $__9mOMSQDhP2__ = \addons\cms\model\Channel::getChannelList(["id"=>"sons","condition"=>"1=isnav","type"=>"son","typeid"=>$son['id'],"cache"=>"0"]); if(is_array($__9mOMSQDhP2__) || $__9mOMSQDhP2__ instanceof \think\Collection || $__9mOMSQDhP2__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__9mOMSQDhP2__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sons): $mod = ($i % 2 );++$i;?>
                            <li><a class="<?php if($sons->is_active): ?>this<?php endif; ?>"  href="<?php echo $sons['url']; ?>"><?php echo $sons['name']; ?></a></li>
                            <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__9mOMSQDhP2__; ?>
                        </ul>
                        <?php endif; ?>
                    </li>

                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__Wewbp8tncX__; ?>
            </ul>
            <?php else: ?>
            <ul>
                <?php $__lJXGhLurk9__ = \addons\cms\model\Archives::getArchivesList(["id"=>"navshow","channel"=>$nav['id'],"orderby"=>"weigh","orderway"=>"desc","flag"=>"top"]); if(is_array($__lJXGhLurk9__) || $__lJXGhLurk9__ instanceof \think\Collection || $__lJXGhLurk9__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__lJXGhLurk9__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navshow): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo $navshow['url']; ?>" title="<?php echo $navshow['title']; ?>"><?php echo $navshow['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__lJXGhLurk9__; ?>
            </ul>
           <?php endif; ?>
        </li>
    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__FyalefNAr5__; ?>
    </ul>

    <?php if(in_array(($site['sousuo']), explode(',',"1"))): ?>
    <div class="sousuonr">
           <form action="/s.html" method="post">
                <input autocomplete = "off" class="form-control" name="q" data-suggestion-url="/addons/cms/search/suggestion.html" type="text" value="" placeholder="Key words">
                <button class="ico icon-icon-test"></button>
            </form>
	</div>
	<?php endif; ?>

   </div>
    </div>
</div>

    <script>
    function fixedb(a,b){
      var topb=$(a).offset().top;
      $(window).scroll(function(){
          var topa=$(window).scrollTop();
          if(topa>topb){
                 $('html').addClass(b);
           } else {
                 $('html').removeClass(b);
           }
      });
    };
    fixedb('#navC','fixedC');
    </script>

<?php break; endswitch; ?>




<!-- wapNav -->
<div class='WapHead'>
    <a class="WapLogo" href="/">
    <?php if(empty($site['logotxt']) || (($site['logotxt'] instanceof \think\Collection || $site['logotxt'] instanceof \think\Paginator ) && $site['logotxt']->isEmpty())): ?>
    <img src="<?php echo $site['logo']; ?>">
    <?php else: ?>
    <?php echo $site['logotxt']; endif; ?></a>
    <i class='ico menu icon-webicon03'></i>
</div>
<div class='WapNav'>
    <ul class="qc">
    <?php $__rjMB2uP4Qg__ = \addons\cms\model\Channel::getChannelList(["id"=>"nav","type"=>"top","cache"=>"0","condition"=>"1=isnav","row"=>"20"]); if(is_array($__rjMB2uP4Qg__) || $__rjMB2uP4Qg__ instanceof \think\Collection || $__rjMB2uP4Qg__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__rjMB2uP4Qg__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?>
        <li>
            <a class="<?php if($nav->is_active): ?>this<?php endif; ?>" <?php if($nav['href'] == 0): ?>href="<?php echo $nav['url']; ?>"<?php endif; if($nav['target'] == 1): ?>target="_blank"<?php endif; ?>><?php echo $nav['name']; ?></a>
            <?php if($nav['has_child']): ?>
            <ul>
                <?php $__Q9PgFUNaEY__ = \addons\cms\model\Archives::getArchivesList(["id"=>"navshow","channel"=>$nav['id'],"orderby"=>"weigh","orderway"=>"desc","flag"=>"top","row"=>"20"]); if(is_array($__Q9PgFUNaEY__) || $__Q9PgFUNaEY__ instanceof \think\Collection || $__Q9PgFUNaEY__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Q9PgFUNaEY__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navshow): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo $navshow['url']; ?>" title="<?php echo $navshow['title']; ?>"><?php echo $navshow['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__Q9PgFUNaEY__; $__v2HiNpIPue__ = \addons\cms\model\Channel::getChannelList(["id"=>"son","type"=>"son","typeid"=>$nav['id'],"cache"=>"0","condition"=>"1=isnav"]); if(is_array($__v2HiNpIPue__) || $__v2HiNpIPue__ instanceof \think\Collection || $__v2HiNpIPue__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__v2HiNpIPue__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$son): $mod = ($i % 2 );++$i;?>

                <li><a class="<?php if($son->is_active): ?>this<?php endif; ?>"  href="<?php echo $son['url']; ?>"><?php echo $son['name']; ?></a>
                     <?php if($son['has_child']): ?>

                     <ul>
                        <?php $__kdez1QvDbZ__ = \addons\cms\model\Channel::getChannelList(["id"=>"sons","type"=>"son","typeid"=>$son['id'],"cache"=>"0","condition"=>"1=isnav","row"=>"20"]); if(is_array($__kdez1QvDbZ__) || $__kdez1QvDbZ__ instanceof \think\Collection || $__kdez1QvDbZ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__kdez1QvDbZ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sons): $mod = ($i % 2 );++$i;?>
                        <li><a class="<?php if($sons->is_active): ?>this<?php endif; ?>"  href="<?php echo $sons['url']; ?>"><?php echo $sons['name']; ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__kdez1QvDbZ__; ?>
                    </ul>
                    <?php endif; ?>
                </li>

                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__v2HiNpIPue__; ?>

            </ul>
             <?php else: ?>
            <ul>
                <?php $__dZryTH71cY__ = \addons\cms\model\Archives::getArchivesList(["id"=>"navshow","channel"=>$nav['id'],"orderby"=>"weigh","orderway"=>"desc","flag"=>"top","row"=>"20"]); if(is_array($__dZryTH71cY__) || $__dZryTH71cY__ instanceof \think\Collection || $__dZryTH71cY__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__dZryTH71cY__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navshow): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo $navshow['url']; ?>" title="<?php echo $navshow['title']; ?>"><?php echo $navshow['title']; ?></a></li>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__dZryTH71cY__; ?>
            </ul>

            <?php endif; ?>
        </li>
    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__rjMB2uP4Qg__; ?>
    </ul>





    <?php if(in_array(($site['sousuo']), explode(',',"1"))): ?>
    <div class="sousuonr">
          <form action="/s.html" method="post">
                <input autocomplete = "off" class="form-control" name="q" data-suggestion-url="/addons/cms/search/suggestion.html" type="text" value="" placeholder="Key words">
                <button class="ico icon-icon-test"></button>
            </form>
	</div>
	<?php endif; ?>


</div>
<!-- wapNav -->-->
<div class="lanmubanner qc">
    <img src="<?php echo $__CHANNEL__['image']; ?>" alt="<?php echo $__CHANNEL__['name']; ?>">
 	<div class="lanmubannerTxt">
		 	<div class="box">
		 		<h2><?php echo $__CHANNEL__['name']; ?></h2>
		 		    
                  
                        <div class="Breadcrumbs">
							<span class="glyphicon glyphicon-home"></span>
                        <?php $__RyvBHT2DcP__ = \addons\cms\model\Channel::getBreadcrumb($__CHANNEL__??[], $__ARCHIVES__??[], $__TAGS__??[], $__PAGE__??[], $__DIYFORM__??[]); if(is_array($__RyvBHT2DcP__) || $__RyvBHT2DcP__ instanceof \think\Collection || $__RyvBHT2DcP__ instanceof \think\Paginator): $k = 0; $__LIST__ = $__RyvBHT2DcP__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k % 2 );++$k;if($k>1): ?>» <?php endif; ?><a title="<?php echo $item['name']; ?>" href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>
        				<?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__RyvBHT2DcP__; ?>
        				</div>
                 
                    
		 	</div>
	</div>
</div>

 

 <div class="About box">
    <?php $__DsSURPaptQ__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"about","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__DsSURPaptQ__) || $__DsSURPaptQ__ instanceof \think\Collection || $__DsSURPaptQ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__DsSURPaptQ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?> 
 	<div class="box">
 	  	<div class="BJQ">
 	  	    <?php if(!(empty($block['image']) || (($block['image'] instanceof \think\Collection || $block['image'] instanceof \think\Paginator ) && $block['image']->isEmpty()))): ?><div class="AboutImg" ><img src="<?php echo $block['image']; ?>"></div><?php endif; ?> 
 	  	    <div class="<?php if(empty($block['image']) || (($block['image'] instanceof \think\Collection || $block['image'] instanceof \think\Paginator ) && $block['image']->isEmpty())): ?>AboutTxt100<?php else: ?>AboutTxt<?php endif; ?>">
 	  	        <?php echo $block['content']; ?>
	 	    </div>
	 	   
	 	</div>
 	</div>
 	<?php if(!(empty($block['images']) || (($block['images'] instanceof \think\Collection || $block['images'] instanceof \think\Paginator ) && $block['images']->isEmpty()))): ?>
 	<ul>
 	  <?php if(is_array(explode(',',$block['images'])) || explode(',',$block['images']) instanceof \think\Collection || explode(',',$block['images']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$block['images']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?>
        <li>
            <img src="<?php echo cdnurl($image); ?>">
            <div>
               <?php if(!(empty($block['intro'][$key]['info']) || (($block['intro'][$key]['info'] instanceof \think\Collection || $block['intro'][$key]['info'] instanceof \think\Paginator ) && $block['intro'][$key]['info']->isEmpty()))): ?><h3><?php echo $block['intro'][$key]['info']; ?></h3><?php endif; if(!(empty($block['intro'][$key]['txt']) || (($block['intro'][$key]['txt'] instanceof \think\Collection || $block['intro'][$key]['txt'] instanceof \think\Paginator ) && $block['intro'][$key]['txt']->isEmpty()))): ?><p><?php echo $block['intro'][$key]['txt']; ?></p><?php endif; ?>
            </div>
        </li> 
      <?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <?php endif; endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__DsSURPaptQ__; ?>  
 	 
 
 	<div class="aboutListBox">
 	    	<?php $__KtW0ShqHE9__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"ab","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__KtW0ShqHE9__) || $__KtW0ShqHE9__ instanceof \think\Collection || $__KtW0ShqHE9__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__KtW0ShqHE9__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?> 
 	    <div class="aboutList">
 	        <div class="aboutListImg"><img src="<?php echo $block['image']; ?>"></div>
 	        <div class="aboutListTxt">
 	            <h3><?php echo $block['title']; ?></h3>
 	            <?php echo $block['content']; ?>
 	        </div>
 	    </div>
 	    	<?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__KtW0ShqHE9__; ?>
 	</div>
 
 	
 </div>

 
<div class="footA"<?php if(!(empty($site['footimg']) || (($site['footimg'] instanceof \think\Collection || $site['footimg'] instanceof \think\Paginator ) && $site['footimg']->isEmpty()))): ?>style="background-image: url(<?php echo $site['footimg']; ?>);"<?php endif; ?>>
       <div class="footHead">
		<div class="footHeadNr box">
			<em>BE IN TOUCH WITH US:</em>
		    <form id="form"  onsubmit="return $('.formPoint').show();" method="POST" action="/d/customer/post.html">
            <input type="hidden" name="__diyname__" value="customer">
            <?php echo token(); ?>
				<input placeholder="Enter your e-mail">
				<button>JOIN US</button>
			</form>

		</div>
	</div>
          <div class="box">
             <div class="footBNr">
                <!--公司介绍 -->
                 <div class="footAA">
                    <h4>About us</h4>
                    <p><?php echo $site['description']; ?></p>
            	 </div>


            	 <div class="footAB">

                <h4>Quick link</h4>

        	    <?php $__qFIU5AMBl0__ = \addons\cms\model\Channel::getChannelList(["id"=>"channel","type"=>"son","condition"=>"1=isnav"]); if(is_array($__qFIU5AMBl0__) || $__qFIU5AMBl0__ instanceof \think\Collection || $__qFIU5AMBl0__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__qFIU5AMBl0__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$channel): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo $channel['url']; ?>" title="<?php echo $channel['name']; ?>"><?php echo $channel['name']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__qFIU5AMBl0__; ?>
              	</div>


        	    <!--菜单-->
        	    <div class="footAB">

                <h4>Services</h4>
        	    <?php $__4JQ59rH16T__ = \addons\cms\model\Archives::getArchivesList(["id"=>"navshow","channel"=>"38","orderby"=>"weigh","orderway"=>"desc","flag"=>"index"]); if(is_array($__4JQ59rH16T__) || $__4JQ59rH16T__ instanceof \think\Collection || $__4JQ59rH16T__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__4JQ59rH16T__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navshow): $mod = ($i % 2 );++$i;?>
                      <a href="<?php echo $navshow['url']; ?>" title="<?php echo $navshow['title']; ?>"><?php echo $navshow['title']; ?></a>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__4JQ59rH16T__; ?>

        	    <div class="footABNr hide">
                <?php $__RVHta1c0kl__ = \addons\cms\model\Archives::getArchivesList(["id"=>"navshow","channel"=>"51","orderby"=>"weigh","orderway"=>"desc","flag"=>"index"]); if(is_array($__RVHta1c0kl__) || $__RVHta1c0kl__ instanceof \think\Collection || $__RVHta1c0kl__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__RVHta1c0kl__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navshow): $mod = ($i % 2 );++$i;?>
                      <a href="<?php echo $navshow['url']; ?>" title="<?php echo $navshow['title']; ?>"><img src="<?php echo $navshow['image']; ?>"><h3><?php echo $navshow['title']; ?></h3></a>
                <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__RVHta1c0kl__; ?>
        		</div>
        		</div>

        	    <!--联系方式-->
            	<div class="footAC">
                    <h4>Contact Us</h4>
                    <ul>
                    <?php $__Y2QFfHkev6__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"contact","orderby"=>"weigh","orderway"=>"desc","condition"=>"1=sf"]); if(is_array($__Y2QFfHkev6__) || $__Y2QFfHkev6__ instanceof \think\Collection || $__Y2QFfHkev6__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Y2QFfHkev6__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
                    <li><span><i class="ico <?php echo $block['image']; ?>"></i></span><p><a href="<?php echo $block['url']; ?>" title=""><?php echo $block['title']; ?> : <?php echo str_replace(["<p>","</p>"], "", $block['content']); ?></a></p></li>
                    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__Y2QFfHkev6__; ?>

                     </ul>
                </div>
            </div>
          </div>

          <!--版权-->
          <div class="copyright">
            <div class="box">
               <?php $__djVgMfeT26__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"zf","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__djVgMfeT26__) || $__djVgMfeT26__ instanceof \think\Collection || $__djVgMfeT26__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__djVgMfeT26__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
              <div class="copyrightRight">

                    <?php if(is_array(explode(',',$block['images'])) || explode(',',$block['images']) instanceof \think\Collection || explode(',',$block['images']) instanceof \think\Paginator): $i = 0; $__LIST__ = explode(',',$block['images']);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$image): $mod = ($i % 2 );++$i;?>
                     <a><img src="<?php echo cdnurl($image); ?>"></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

              </div>
              <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__djVgMfeT26__; ?>

              <div class="copyrightLeft">
                <a href=""><?php echo $site['beian']; ?></a>
              </div>

              <div class="shemei">
			    <?php $__Yjpwfmo1JQ__ = \addons\cms\model\Block::getBlockList(["id"=>"block","name"=>"sm","orderby"=>"weigh","orderway"=>"desc"]); if(is_array($__Yjpwfmo1JQ__) || $__Yjpwfmo1JQ__ instanceof \think\Collection || $__Yjpwfmo1JQ__ instanceof \think\Paginator): $i = 0; $__LIST__ = $__Yjpwfmo1JQ__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$block): $mod = ($i % 2 );++$i;?>
				<a href="<?php echo $block['url']; ?>" title="<?php echo $block['title']; ?>" target="_blank"><i class="ico <?php echo $block['image']; ?>"></i></a>
			    <?php endforeach; endif; else: echo "" ;endif; $__LASTLIST__=$__Yjpwfmo1JQ__; ?>
			</div>
            </div>
          </div>
    </div>


 <script type="text/javascript">
          $('body').append('<div class="formPoint"><div id="loading1"><div class="demo1"></div><div class="demo1"></div><div class="demo1"></div><div class="demo1"></div><div class="demo1"></div></div></div>')
</script>


<script type="text/javascript" src="/template/default1/js/common.js?v=<?php echo $site['version']; ?>"></script>
</body>
</html>
 