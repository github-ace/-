//插图片、插视频调用代码
$(document).ready(function () {
    $('.trigger-img').click(function () {
        $('.diary-file').attr("accept", "image/jpeg,image/png,image/gif,").trigger('click');
    });
    $('.trigger-video').click(function () {
        $('.diary-file').attr('accept', 'video/mp4,video/webm,video/ogg').trigger('click');
    });
})
//预览上传图片代码
$(document).ready(function () {
    $('.diary-file').change(function (e) {
        var ele = $(e.target)[0].files[0];
        var fr = new FileReader();
        fr.onload = function (ele) {
            $('.view-image').append("<img alt='预览图片' src='" + ele.target.result + "'/>");
        };
        fr.readAsDataURL(ele);
        //修改插入图片按钮文字
        if($('.diary-file').value!='undefined'){
           $('.trigger-img').text('再插入一张图片') 
           $('.trigger-video').hide(); 
        };
        
        //调整图片预览框的尺寸
        switch ($('.view-image img').size()) {
            case 1:
                //暂图片预览框为400px
                break;
            case 2:
                //暂定为400px
                break;
            case 3:
                //暂定为400px
                break;
            case 4:

                break;
            case 5:

                break;
            case 7:

                break;
            case 8:

                break;
            case 9:

                break;
        }
    });
})