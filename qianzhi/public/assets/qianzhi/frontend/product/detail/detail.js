define(["../../../../../assets/libs/art-template/dist/template.js"], function (
  Template
) {
  const productDetail = {
    data: {},

    init() {
      this.events();
    },

    events() {
      $('video').on('contextmenu', function () {
        return false;
      });

      var $bigImg = $('.big-img-wrap')
      $('.small-img-wrap').on('click', 'img', function () {
        var $this = $(this)
        var src = $this.attr('src')
        $bigImg.find('img').attr('src', src)
      })
    },
  };

  return {
    productDetail: productDetail.init(),
  };
});
