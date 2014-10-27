seajs.config({

  // 别名配置
  alias: {
    'json': 'asset/js/sea-modules/gallery/json/1.0.3/json',
    'jquery': 'asset/js/sea-modules/jquery/jquery/2.1.0/jquery',
    'bootstrap': 'asset/js/common/bootstrap'
  },

/*  // 路径配置
  paths: {
    'gallery': 'https://a.alipayobjects.com/gallery'
  },*/

  // 变量配置
  vars: {
    'locale': 'zh-cn'
  },

/*  // 映射配置
  map: [
    ['http://example.com/js/app/', 'http://localhost/js/app/']
  ],*/

  // 预加载项
  preload: [
    this.JSON ? '' : 'json'
  ],

/*  // 调试模式
  debug: true,*/

  // Sea.js 的基础路径
  base: app.jspath,

  // 文件编码
  charset: 'utf-8'
});