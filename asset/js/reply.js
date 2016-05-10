

define('/asset/js/reply', function(require, exports, module) {

    $('.chat_but').on('tap', function() {

        $.post('/group/post/add', $('#reply-form').serialize(), function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.reload();
            } 
        }) 
    })

});
