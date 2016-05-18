

define('/asset/js/scarfPost', function(require, exports, module) {

    $(".cancel_but").on("tap",function(){
        location.href = "/scarf";
    })

    $('.post_but').on('tap', function() {

        $.post('/user/scarf/doadd', $('#post-form').serialize(), function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.href = "/scarf";
            } else {
                $('.message').show();
                $('.alert-info').html(res.info);
            }
        }) 
    })

});
