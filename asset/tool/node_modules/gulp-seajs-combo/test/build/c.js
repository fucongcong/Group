define('d',function(){
    return 'd';
});
define('c',['d','e'],function( require, exports, module ){
    var d = require('d');
require('e');

    module.exports = d;
});

