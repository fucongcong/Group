define('j',function(){
    return 'j';
});

define('h',function(){
    return 'h';
});
define('g',['j'],function(require){
    var j=require('j');
    return 'g' + ' ' + j;
});

seajs.use( ['g','h'], function( g, h ){
    console.log( g );
    console.log( h );
});

