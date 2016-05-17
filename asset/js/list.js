

define('/asset/js/list', function(require, exports, module) {

    $(".post_but").on("tap",function(){
        location.href = "/group/post";
    })

    var pageCount = 1;
    var dragger = new DragLoader(document.getElementsByClassName('list_body')[0], {
            dragDownRegionCls: 'latest',
            dragUpRegionCls: 'more',
            // dragDownHelper: function(status) {console.log(1);
            //     if (status == 'default') {
            //         return '<div>向下拉加载最新</div>';
            //     } else if (status == 'prepare') {
            //         return '<div>释放刷新</div>';
            //     } else if (status == 'load') {
            //         return '<div>加载中...</div>';
            //     }
            // },
            dragUpHelper: function(status) {
                if (status == 'default') {
                    return '<div style="text-align:center;">向上拉加载更多</div>';
                } else if (status == 'prepare') {
                    return '<div style="text-align:center;">释放刷新</div>';
                } else if (status == 'load') {
                    return '<div style="text-align:center;">加载中...</div>';
                }
            }
        });
        // dragger.on('dragDownLoad', function() {console.log(1)
        //     setTimeout(function() {
        //         // 无论何时，必须由业务功能主动调用reset()接口，以还原状态
        //         // 比如在onDragDownLoad()回调中使用ajax加载数据时，在ajax的回调函数中应当调用reset()重置drag状态
        //         // 如果不重置，drag操作将失效
        //         dragger.reset();
        //     }, 200);
        // });
        dragger.on('dragUpLoad', function() {
            key = $('#list_body').data('key');
            $.get('/group/list/more', {start:pageCount * 10, key:key}, function(res){
                $('.ul-list').append(res);
                pageCount++;
                dragger.reset();
            })
        });
});
