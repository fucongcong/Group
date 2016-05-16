

define('/asset/js/follows', function(require, exports, module) {

    $(".follows").on("tap",function(){
        location.href = "/user/follows";
    })

    $(".follower").on("tap",function(){
        location.href = "/user/follower";
    })
});
