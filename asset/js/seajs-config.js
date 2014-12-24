seajs.config({

  // 别名配置
  alias: {
    'json': 'gallery/json/1.0.3/json',
    'jquery': 'jquery/jquery/1.10.1/jquery',
    '$-debug': 'jquery/jquery/1.10.1/jquery-debug',
    '$': 'jquery/jquery/1.10.1/jquery',
    "jquery.cycle2": "jquery-plugin/cycle2/2013.08.01/cycle2",
    'bootstrap': 'gallery2/bootstrap/3.1.1/bootstrap',
    'slider': 'gumutianqi/bootstrap-slider/2.0.0/bootstrap-slider',
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
    this.JSON ? '' : 'json',

  ],

/*  // 调试模式
  debug: true,*/

  // Sea.js 的基础路径
  base: app.jspath,

  // 文件编码
  charset: 'utf-8'
});
