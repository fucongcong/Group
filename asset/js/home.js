
define('/asset/js/home', function(require, exports, module) {

    $(".tab_box1").on("tap",function(){
        location.href = "/";
    })

    $(".tab_box2").on("tap",function(){
        location.href = "/group/list";
    })

    $(".tab_box3").on("tap",function(){
        
    })

    $(".tab_box4").on("tap",function(){
        location.href = "/user";
    })

    $(".menu1").on("tap",function(){
        location.href = "../thank.html";
    })
    $(".menu2").on("tap",function(){
        location.href = "/group/list";
    })
    $(".menu3").on("tap",function(){
        location.href = "/group/list";
    })
    $(".menu4").on("tap",function(){
        location.href = "/user";
    })
});