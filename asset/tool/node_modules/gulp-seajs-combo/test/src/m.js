seajs.config({

  // 别名配置
  alias: {
    'i' : 'alias/i'
  },

  // 路径配置
  paths: {
    'foo': 'foo/bar/biz'
  },

  // 变量配置
  vars: {
    'locale': 'zh-cn'
  },

  // 映射配置
  map: [
    ['http://example.com/js/app/', 'http://localhost/js/app/']
  ],

  // 预加载项
  preload: [
    Function.prototype.bind ? '' : 'es5-safe',
    this.JSON ? '' : 'json'
  ],

  // 调试模式
  debug: true,

  // Sea.js 的基础路径
  base: 'src',

  // 文件编码
  charset: 'utf-8'
});

var hello = 'hello';

seajs.use( ['{locale}/n', 'i', 'o'], function(){
    var args = Array.prototype.join.call( arguments, ', ' );
    console.log( args + ' is done' );
});
