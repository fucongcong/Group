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

seajs.use( 'g', function( g ){
    console.log( g );
});

seajs.use( 'h', function( h ){
    console.log( h );
});

