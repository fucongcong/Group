define('/asset/js/test1', function(require, exports, module) {
    
    console.log("load 2");

    exports.hello=function(){

        console.log('hello  I am 2');
    } ; 

});