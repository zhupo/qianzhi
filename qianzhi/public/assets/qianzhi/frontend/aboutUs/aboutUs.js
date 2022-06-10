define(["../../../../../assets/libs/art-template/dist/template.js"], function (
  Template
) {
  const aboutUs = {
    data: {},

    init() {
      this.events();
    },

    events() {
      var that = aboutUs
      $("video").on("contextmenu", function () {
        return false;
      });

      $("#liveSlide").roundabout({
        startingChild: 1, // 默认的显示第几张图片
        easing: "easeOutInCirc",
        duration: 600, // 运动速度
        autoplay: false, // 自动播放
        minScale: 0.5,
        autoplayDuration: 5000,
        minOpacity: 0.8, //最小的透明度
        maxOpacity: 1, //最大的透明度
        reflect: false,
        startingChild: 0,
        autoplayInitialDelay: 5000,
        autoplayPauseOnHover: false,
        enableDrag: true,
        clickToFocusCallback: function () {
          // 点击当前轮播设为焦点回调
          liveChange();
        },
        autoplayCallback: function () {
          // 自动轮播的回调
          liveChange();
        },
      });
      var liveChange = function () {
        var index = $(".roundabout-in-focus").index();
        $("#dotList")
          .find("span")
          .removeClass("active")
          .eq(index)
          .addClass("active");
      };
      liveChange();

      var mySwiper = new Swiper ('.swiper', {
        slidesPerView: that.getSliderPerView(),
        grid: {
          rows: 2,
        },
        spaceBetween: 0,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }
      })  
    },

    getSliderPerView () {
      var wid = window.outerWidth
      if (wid < 640) {
        return 1
      } else if (wid < 990) {
        return 2
      } else {
        return 3
      }
    }
    
  };

  return {
    aboutUs: aboutUs.init(),
  };
});
