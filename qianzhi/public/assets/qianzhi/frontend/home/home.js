define([
  '../../../../assets/libs/art-template/dist/template.js',
  '../../../../assets/qianzhi/frontend/home/homeData.js'
], function (Template, homeData) {
  const $elms = {
    ourProduct: $('#ourProduct'),
    ourProductTemplate: $('#ourProductTemplate'),

    aboutUs: $('#aboutUs'),
    aboutUsTemplate: $('#aboutUsTemplate'),

    partners: $('#strategicPartners'),
    partnersTemplate: $('#strategicPartnersTemplate'),

    news: $('#newsCenter'),
    newsTemplate: $('#newsCenterTemplate')
  }

  const homePage = {
    data: {
      temp: {
        ourProduct: Template.compile($elms.ourProductTemplate.html()),
        aboutUs: Template.compile($elms.aboutUsTemplate.html()),
        partners: Template.compile($elms.partnersTemplate.html()),
        news: Template.compile($elms.newsTemplate.html())
      }
    },

    init() {
      this.events()
      this.render()

    },

    render() {
      const that = homePage
      $elms.ourProduct.html(that.data.temp.ourProduct({
        products: homeData.ourProduct
      }))

      $elms.aboutUs.html(that.data.temp.aboutUs({
        aboutUs: homeData.aboutUs,
        setCol: function(index) {
          return index === 1 ? 6 : 3
        },
        setDefaultActive: function(index) {
          return index === 0 ? 'active' : ''
        }
      }))

      $elms.partners.html(that.data.temp.partners({
        partners: homeData.partners
      }))

      $elms.news.html(that.data.temp.news({
        news: homeData.news
      }))

      setTimeout(() => {
        $('.carousel').carousel()
      }, 1000)
    },


    events() {
      
      homePage.setBannerHeight()

      window.onresize = function () {
        homePage.setBannerHeight()
      }

      var mySwiper = new Swiper('.swiper', {
        loop: true,
        slidesPerView: 1,
        loopPreventsSlide: true, //默认true，阻止
        autoplay: {
          delay: 3000,
          disableOnInteraction: false,
          pauseOnMouseEnter: true,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        // navigation: {
        //   nextEl: '.swiper-button-next',
        //   prevEl: '.swiper-button-prev',
        // },
      })
      
    },

    setBannerHeight () {
      var winHeight = $(window).height()
      $('.home-header').height(winHeight)
    }
  };

  return {
    homePage: homePage.init(),
  };
});
