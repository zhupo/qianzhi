define([
  '../../../../../assets/libs/art-template/dist/template.js'
], function (Template) {

  const listItems =  Array(9).fill({
    image: '../../../../../assets/img/png/robot-product-01.png',
    title: 'Plant Protection Robot',
    description: 'The EOD robot is a special equipment used by the blasting personal.'
  })

  const $elms = {
    list: $('#productList'),
    listTemplate: $('#productListTemplate')
  }

  const productList = {
    data: {
      temp: {
        list: Template.compile($elms.listTemplate.html()),
      }
    },

    init() {
      // this.events()
      this.render()

    },

    render() {
      const that = productList
      $elms.list.html(that.data.temp.list({
        productList: listItems
      }))
    },


    // events() {
    //   // https://flaviusmatis.github.io/simplePagination.js/#page-20
    //   $('#pagination').pagination({
    //     items: 20,
    //     itemOnPage: 9,
    //     currentPage: 1,
    //     cssStyle: '',
    //     prevText: '<span aria-hidden="true">&laquo;</span>',
    //     nextText: '<span aria-hidden="true">&raquo;</span>',
    //     onInit: function () {
    //         // fire first page loading
    //     },
    //     onPageClick: function (page, evt) {
    //         // some code
    //     }
    //   });
    //
    // },
  };

  return {
    productList: productList.init(),
  };
});
