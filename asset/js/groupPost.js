

define('/asset/js/groupPost', function(require, exports, module) {

    $(".cancel_but").on("tap",function(){
        location.href = "/group/list";
    })

    $('.post_but').on('tap', function() {

        $.post('/group/add', $('#post-form').serialize(), function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                gid = res.data.gid;
                location.href = "/group/"+gid;
            } else {
                $('.message').show();
                $('.alert-info').html(res.info);
            }
        }) 
    })

});
