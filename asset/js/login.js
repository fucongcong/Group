
define('/asset/js/login', function(require, exports, module) {

    //window.$ = window.jQuery = require('jquery');

    $('.login_but').on('tap', function() {

        $.post('/doLogin', $('#login-form').serialize(), function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.href = "/";
            } else {
                $('.info').show();
                $('.alert-info').html(res.info);
            }
        }) 

    })

    $(".go_reg").on("tap",function(){
        location.href="/register";
    })
});