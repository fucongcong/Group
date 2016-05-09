
define('/asset/js/register', function(require, exports, module) {

    //window.$ = window.jQuery = require('jquery');

    $('.register_but').on('tap', function() {

        $.post('/doRegister', $('#register-form').serialize(), function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.href = "/login";
            } else {
                $('.info').show();
                $('.alert-info').html(res.info);
            }
        }) 
    })

    $(".go_log").on("tap",function(){
        location.href="/login";
    })
});