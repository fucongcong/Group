define('p',function(){
    return 'p'; 
});
define('o',['p'],function(require){
    var p=require('p')
    return 'o' + ' ' + p
} )

define('i',function(){
    return 'i'; 
});
define('n',function(){
    return 'n';
});



var hello = 'hello';

seajs.use( ['n', 'i', 'o'], function(){
    var args = Array.prototype.join.call( arguments, ', ' );
    console.log( args + ' is done' );
});

