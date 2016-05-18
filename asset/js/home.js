
define('/asset/js/home', function(require, exports, module) {

    $(".tab_box1").on("tap",function(){
        location.href = "/";
    })

    $(".tab_box2").on("tap",function(){
        location.href = "/group/list";
    })

    $(".tab_box3").on("tap",function(){
        location.href = "/scarf";
    })

    $(".tab_box4").on("tap",function(){
        location.href = "/user";
    })

    $(".menu1").on("tap",function(){
        location.href = "/scarf";
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

    $(".user-link").on("tap",function(){
        uid = $(this).data('id');
        location.href = "/user/info/"+uid;
    })

    $(".post-scarf").on("tap",function(){
        location.href = "/user/scarf/add";
    })

    $("body").on("tap", ".go_detail", function(){
        gid = $(this).data('gid');
        location.href = "/group/"+gid;
    })

    $('.message-link').on('tap', function() {
       uid = $(this).data('id');
       location.href = '/user/message/info/'+uid;
    })

    $(".scarf").on("tap",function(){
        location.href = "/scarf";
    })

    $(".thank").on("tap",function(){
        location.href = "/scarf/thank";
    })
});