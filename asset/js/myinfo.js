
define('/asset/js/myinfo', function(require, exports, module) {
    require('/asset/js/list');
    $('.post_but').on('tap', function() {
        location.href = "/user/changeInfo";
    })
});