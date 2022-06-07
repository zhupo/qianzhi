define([
  '../../../../assets/libs/art-template/dist/template.js',
  '../../../../assets/qianzhi/frontend/home/homeData.js'
], function (Template, homeData) {
  const $elms = {
    searchBtn: $("#js-search-btn"),
    searchInput: $("#js-search-input"),
    searchFrom: $("#js-search-from"),

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
      const that = homePage;
      $elms.searchBtn.off("click").on("click", function () {
        if ($elms.searchInput.is(":visible")) {
          $($elms.searchInput)
            .animate(
              {
                width: "0",
              },
              800
            )
            .hide(1);
        } else {
          $elms.searchInput.show().animate({
            width: "170px",
          });
        }
      });
    },
  };

  return {
    homePage: homePage.init(),
  };
});
