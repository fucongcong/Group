define('u.tpl',function(){return Handlebars.template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
    return "<div>This is test Handlebars tpl.</div>";
},"useData":true})});
define('d',function(){
    return 'd';
});
define('b',function(){
    return 'b'; 
});
define('q',['b','u.tpl','d'],function( require ){
    require('b');
    var tpl = require('u.tpl');
    require('d');
    console.log( tpl );
});

