define('b',function(){
    return 'b'; 
});
define('a',['b'],function( require, exports, module ){
    var b = require('b');
    module.exports = 'a' + ' ' + b;
});

