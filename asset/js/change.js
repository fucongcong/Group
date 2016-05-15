
define('/asset/js/change', function(require, exports, module) {

    $('.login_but').on('tap', function() {

        $.post('/user/doChangeInfo', $('#info-form').serialize(), function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                uid = $('#info-form').data('id');
                 location.href = "/user/info/"+uid;
            } else {
                $('.info').show();
                $('.alert-info').html(res.info);
            }
        }) 
    })

});