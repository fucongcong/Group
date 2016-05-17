

define('/asset/js/info', function(require, exports, module) {

    $(".feed_back").on("tap",function(){
        location.href = "/login_out";
    })

    $(".list-changeInfo").on("tap",function(){
        uid = $(this).data('id');
        location.href = "/user/info/"+uid;
    })

    $(".list-friends").on("tap",function(){
        location.href = "/user/follows";
    })

    $(".list-collect").on("tap",function(){
        location.href = "/user/collect";
    })

    $(".list-messages").on("tap",function(){
        location.href = "/user/messages";
    })
    
    
});