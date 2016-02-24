define('/asset/js/index', function(require, exports, module) {
    
  // 通过 require 引入依赖
  window.$ = window.jQuery = require('jquery');
  require('bootstrap');
  var test=require('/asset/js/test.js');
  console.log("test load");
  test.hello();

  var test1=require('/asset/js/test1.js');
  console.log("test1 load");
  test1.hello();

  console.log("hello over");
/*
  require('jquery.cycle2');*/

});