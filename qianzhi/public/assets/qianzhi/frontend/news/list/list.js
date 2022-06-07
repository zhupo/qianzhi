define([
  '../../../../../assets/libs/art-template/dist/template.js'
], function (Template) {

  const listItems = [
    {
      image: '../../../../../assets/qianzhi/frontend/news/news-01.png',
      title: 'Company website official launch notice',
      date: '2019-04-01',
      description: 'Hunan Qianzhi Robot Technology Development Co., Ltd. was established in October 2015 with a registered capital of RMB 150 million. It is a high-tech enter price specializing in the design and manufacture of special robots, service robots, R&D, manufacturing and automation equipment.'
    },
    {
      image: '../../../../../assets/qianzhi/frontend/news/news-02.jpg',
      title: 'Company website official launch notice',
      date: '2019-04-01',
      description: 'Hunan Qianzhi Robot Technology Development Co., Ltd. was established in October 2015 with a registered capital of RMB 150 million. It is a high-tech enter price specializing in the design and manufacture of special robots, service robots, R&D, manufacturing and automation equipment.'
    },
    {
      image: '../../../../../assets/qianzhi/frontend/news/news-03.jpg',
      title: 'Company website official launch notice',
      date: '2019-04-01',
      description: 'Hunan Qianzhi Robot Technology Development Co., Ltd. was established in October 2015 with a registered capital of RMB 150 million. It is a high-tech enter price specializing in the design and manufacture of special robots, service robots, R&D, manufacturing and automation equipment.'
    },
    {
      image: '../../../../../assets/qianzhi/frontend/news/news-04.jpg',
      title: 'Company website official launch notice',
      date: '2019-04-01',
      description: 'Hunan Qianzhi Robot Technology Development Co., Ltd. was established in October 2015 with a registered capital of RMB 150 million. It is a high-tech enter price specializing in the design and manufacture of special robots, service robots, R&D, manufacturing and automation equipment.'
    }
  ]

  const $elms = {
    list: $('#newsList'),
    listTemplate: $('#newsListTemplate')
  }

  const newsList = {
    data: {
      temp: {
        list: Template.compile($elms.listTemplate.html()),
      }
    },

    init() {
      this.events()
      this.render()

    },

    render() {
      const that = newsList
      $elms.list.html(that.data.temp.list({
        newsList: listItems
      }))
    },


    events() {
      
    },
  };

  return {
    newsList: newsList.init(),
  };
});
