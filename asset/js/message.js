


define('/asset/js/message', function(require, exports, module) {

    $('.chat_but').on('tap', function() {
        $.post('/user/message/add', $('#reply-form').serialize(), function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.reload();
            } 
        }) 
    })
    
});
