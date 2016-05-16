

define('/asset/js/reply', function(require, exports, module) {

    $('.chat_but').on('tap', function() {
        $.post('/group/post/add', $('#reply-form').serialize(), function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.reload();
            } 
        }) 
    })

    $('.colloect').on('tap', function() {
        gid = $(this).data('id');
        $.post('/group/collect', {gid:gid}, function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.reload();
            } 
        }) 
    })

    $('.uncollect').on('tap', function() {
        gid = $(this).data('id');
        $.post('/group/unCollect', {gid:gid}, function(res){
            res = $.parseJSON(res);
            if (res.status == 1) {
                location.reload();
            } 
        }) 
    })
    
});
