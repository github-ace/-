//登录框
$(document).ready(function () {
    var yanzheng_w = ($(window).width() - $('.yanzheng').width()) / 2;
    var yanzheng_h = ($(window).height() - $('.yanzheng').height()) / 2;
    $('.yanzheng').css({'top': yanzheng_h,'left':yanzheng_w});
})
//警示框
$(document).ready(function () {
    $('.alert').css({ 'top': '50%', 'left': '50%' })
    $('.alert').fadeOut(2000);
})
