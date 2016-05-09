
define('/asset/js/register', function(require, exports, module) {

    window.$ = window.jQuery = require('jquery');

    $('#register').on('click', function() {

        $.post('/doRegister', $('#register-form').serialize(), function(res){
            res = jQuery.parseJSON(res);
            if (res.status == 1) {
                window.location.href = "/login";
            } else {
                $('.info').show();
                $('.alert-info').html(res.info);
            }
        }) 

    })
});