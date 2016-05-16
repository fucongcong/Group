

define('/asset/js/list', function(require, exports, module) {

    $(".post_but").on("tap",function(){
        location.href = "/group/post";
    })

    var loadingCount = 0,
        totalPages = 4;
    var pageCount;
    // using jQuery plugin instantiation
    $('.list_body').infiniteScrollHelper({
        
        loadMore: function(page, done) {
            // ajax request would be kicked off here
            pageCount = page;
            //$('.loader').text('Loading Page ' + page + '...');

            // simulating loading of some content
            setTimeout(
                function() {
                    key = $('.list_body').data('key');
                    $.get('/group/list/more', {start:pageCount * 10, key:key}, function(res){
                        $('.list_body').append(res);
                    })
                    

                    if (pageCount == totalPages) { // if we are at the last page, destroy the plugin instance
                        console.log('desroying');
                        $('.list_body').infiniteScrollHelper('destroy');
                    }

                    done();
                } 
            , 2000);
        },
        bottomBuffer: 80,
        // using the triggerInitialLoad option
        triggerInitialLoad: true
    })
});
