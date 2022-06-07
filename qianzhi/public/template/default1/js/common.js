/**
 * 
 * 
 * @date  周江寿2021年4月7日14:31:06
 *  
 */
// ie浏览器检测
if(window.navigator.userAgent.indexOf('AppleWebKit') != -1) { 
}else{
}
function getIEVersion(){
    var ua = navigator.userAgent;
    var ver = 11;
    if(ua){
            if(ua.match(/MSIE\s+([\d]+)\./i)){
                    ver = RegExp.$1;
            }else if(ua.match(/Trident.*rv\s*:\s*([\d]+)\./i)){
                    ver = RegExp.$1;
            }
    }
    return parseInt(ver);
}        
if(getIEVersion()<11) {alert('您目前的IE版本太低，请升级后浏览！Your current version of IE is too low, please browse after upgrading!');}
//获取屏幕宽高
var w = document.documentElement.clientWidth;
var h = document.documentElement.clientHeight;

//设置htmlfontSize
;(function (win) {
  resizeRoot();
    function resizeRoot() {
    var width = document.documentElement.clientWidth;
     if (document.documentElement.clientWidth>750) {
      document.documentElement.style.fontSize = width/19.03 + 'px';
     } else {
      document.documentElement.style.fontSize = width/7.5 + 'px';
     }
  }
  window.onresize = resizeRoot;
})(window);

//清除样式
$(function(){
  $('.BJQ *').removeAttr("style").removeAttr("width").removeAttr("height").removeAttr("valign").removeAttr("color");
  $(".BJQ table").wrap("<div style='overflow-x:auto;padding: 10px 0;'></div>");
});

//二级导航
$("#indexNav  li").hover(function(){
     $(this).children('ul').slideDown(300); 
},function(){
     $(this).children('ul').stop(true,true).slideUp(200);
});

//导航当前状态
// $(function(){   
//   $("a").each(function(){ 
//     if(this.href==String(window.location)){  
//         $(this).addClass('this').siblings().removeClass("this");
//         }
//     }) 
// })

//如果有二级菜单追加下拉图标 
$("#nav>li>a").each(function(){
  var s=$(this).next("ul").find("li").length;
    if (s>0) {
        $(this).append('<i class="ico icon-icon---copy-copy"></i>')
    }  
});



$("#indexNav li").each(function(){
  var s=$(this).find("ul").find("li").length;
    if (s==0) {
        $(this).find("ul").remove();
    }  
});

//移动端导航 
$(".WapNav>ul>li a").each(function(){
  var s=$(this).next("ul").find("li").length;
    if (s>0) {$('<i class="ico icon-jiahao"></i>').insertAfter(this);}  
});
$('.WapHead .menu').click(function(){
    $('html').toggleClass('wapnav');
    if ($('html').hasClass("wapnav")) {
      $(this).attr("class","ico menu icon-guanbi");
    } else {
      $(this).attr("class","ico menu icon-webicon03");
    };
});
$('.WapNav>ul i').click(function(){
    $(this).toggleClass("this");
    $(this).parent('li').siblings('li').find("i").attr("class","ico icon-jiahao");
      if ($(this).hasClass("this")) {
        $(this).attr("class","this  ico icon-minus");
      } else {
          $(this).attr("class","ico icon-jiahao");
      };
    $(this).next('ul').slideToggle('');
    $(this).parent('li').siblings('li').find("ul").slideUp("");
});


//导航1固定
function positionnNav(){
  $(window).scroll(function(){ 
  var top=$(window).scrollTop()
     if(top>0){$('html').addClass("box-shadow")}
     else{$('html').removeClass("box-shadow")}
  });
};
positionnNav('html');
$("html").scroll(); 

var Top1 = $(window).scrollTop();
$(window).scroll(function(){
	var Top2 = $(document).scrollTop();
	if(Top2 > Top1){ 
		$('html').addClass("fixed")
	} else { 
	$('html').removeClass("fixed")
 	}
	Top1 = Top2
});
 



//tab切换
function tab(a){
  $(a.menu).children().eq(0).addClass(a.style); 
  $(a.box).children().eq(0).siblings().hide(); 
  $(a.menu).children().bind(a.event,function(){  
      $(this).addClass(a.style).siblings().removeClass(a.style);
      $(a.box).children().hide().eq($(this).index()).show();
  });
}; 
// tab({
//   menu:'.nav2',
//   box:'.box2',
//   event:'mouseenter',
//   style:'this'
// })

//折叠
function fold(a){
    $(a.title).each(function(){
       if ($(this).hasClass(a.style)){
          $(this).next().show();
       }
    });
    $(a.title).click(function(){
      $(this).next().slideToggle().parents().siblings().children(a.content).slideUp();
      $(this).toggleClass(a.style).parents().siblings().children().removeClass(a.style);
      if ($(this).hasClass(a.style)){
         $(this).find('i').attr("class",a.show); 
      }else{
         $(this).find('i').attr("class",a.hide); 
      };
      $(this).parents().siblings('dl').find('dt').find('i').attr("class",a.hide); 
  });
}; 
fold({
  title:'.FqaRight dt',
  content:'.FqaRight dd',
  style:'this',
  hide:'ico icon-jiahao',
  show:'ico icon-minus'
})




// $(".BJQ ul li").prepend("<i class='ico icon-choice2'></i>");


$('.pageUl ul').lightGallery();
$('.pageOl ol').lightGallery();
$('.pageImgs ul').lightGallery();
$('.pageImgs ol').lightGallery();
$('.ServicesParameterUl').lightGallery();
$('.ServicesShowImglist').lightGallery();
$('.ProjectImgs').lightGallery();


if ($('.Pagination *').length==0) {$('.Pagination').hide()}


/*--------------------------------------------End of common part----------------------------------------*/
 



var productShowImg = new Swiper('#productShowImg', {
  observer:true,
  observeParents:true,
  slidesPerColumnFill : 'column', //column row
  slidesPerView: 1, 
  spaceBetween: 0,
  slidesPerColumn: 1,//行
  slidesPerGroup: 1,//移动个数
  loop: true,
  pagination: {
  el: '#productShowImg .swiper-pagination',
  clickable: true,
 
  },
  navigation: {
  nextEl: '#productShowImg .swiper-button-next',
  prevEl: '#productShowImg .swiper-button-prev',
  },
  autoplay: {
  delay: 3000000, 
  disableOnInteraction: false,
  },
    breakpoints:{
  1600:{slidesPerView: 1,spaceBetween: 0, slidesPerColumn:1,},
  1279:{slidesPerView: 1,spaceBetween: 0,slidesPerColumn:1,},
  750:{slidesPerView: 1,spaceBetween: 0,slidesPerColumn:1,},
  },
  
 
});
  
 
 
 
 var FdcShow = new Swiper('#FdcShow', {
  observer:true,
  observeParents:true,
  slidesPerColumnFill : 'column', //column row
  slidesPerView: 2, 
  spaceBetween: 0,
  slidesPerColumn: 1,//行
  slidesPerGroup: 1,//移动个数
  loop: true,
  pagination: {
  el: '#FdcShow .swiper-pagination',
  clickable: true,
 
  },
  navigation: {
  nextEl: '#FdcShow .swiper-button-next',
  prevEl: '#FdcShow .swiper-button-prev',
  },
  autoplay: {
  delay: 3000000, 
  disableOnInteraction: false,
  },
    breakpoints:{
  1600:{slidesPerView: 2,spaceBetween: 0, slidesPerColumn:1,},
  1279:{slidesPerView: 1,spaceBetween: 0,slidesPerColumn:1,},
  750:{slidesPerView: 1,spaceBetween: 0,slidesPerColumn:1,},
  },
  
 
});


 var Project = new Swiper('#Project', {
  observer:true,
  observeParents:true,
  slidesPerColumnFill : 'column', //column row
  slidesPerView: 2, 
  spaceBetween: 10,
  slidesPerColumn: 1,//行
  slidesPerGroup: 1,//移动个数
  loop: true,
  pagination: {
  el: '#Project .swiper-pagination',
  clickable: true,
 
  },
  navigation: {
  nextEl: '#Project .swiper-button-next',
  prevEl: '#Project .swiper-button-prev',
  },
  autoplay: {
  delay: 3000000, 
  disableOnInteraction: false,
  },
    breakpoints:{
  1600:{slidesPerView: 2,spaceBetween:20, slidesPerColumn:1,},
  1279:{slidesPerView: 2,spaceBetween: 10,slidesPerColumn:1,},
  750:{slidesPerView: 2,spaceBetween: 10,slidesPerColumn:1,},
  },
  
 
});
  
 
 
 
 
 
 
 $(".WapNav>ul>li").each(function(){
  var s=$(this).find("ul").find("li").length;
    if (s==0) {
        $(this).find("ul").remove();
    }  
});
 
 
 
 $('.WapNav>ul>li>a').click(function(){
      var s=$(this).siblings("ul").length;
     if (s>0) {
        $(this).next('i').click();
    } else{
         $('.WapHead .menu').click();
    }
});

 

    


 $('.CartIco em').html(localStorage.length);

