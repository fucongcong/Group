

define('/asset/js/list', function(require, exports, module) {

    $(".post_but").on("tap",function(){
        location.href = "/group/post";
    })

    $(".go_detail").on("tap",function(){
        gid = $(this).data('gid');
        location.href = "/group/"+gid;
    })

});
