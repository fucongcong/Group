
define('/asset/js/myinfo', function(require, exports, module) {
  
    $('.post_but').on('tap', function() {
        location.href = "/user/changeInfo";
    })

    $('.unfollow').on('tap', function() {
       fuid = $(this).data('id');
       $.post('/user/unfollow', {fuid:fuid}, function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.reload();
            } 
        }) 
    })

    $('.follow').on('tap', function() {
       fuid = $(this).data('id');
       $.post('/user/follow', {fuid:fuid}, function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.reload();
            } 
        }) 
    })
});