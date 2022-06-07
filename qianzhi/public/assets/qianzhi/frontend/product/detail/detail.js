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
    },
  };

  return {
    productDetail: productDetail.init(),
  };
});
