//设置文章列表图片的宽度
var setImgWidth = function () {
    $('.list-article-img a img').each(function () {
        var img =new Image();
        img.src =$(this).attr("src");
        var realWidth =img.width;
        var realHeight =img.height;
        var cateW = $(this).parent().width();
        if(realHeight/realWidth >1){
            //console.log($(this).parent());
            $(this).parent().css({
                'overflow':'hidden',
                'height':cateW*0.7
            });
        }
    });

    $('.news-img-hover img').each(function () {
        if ($(this).attr("src") == "") {
            $(this).each(function () {
                $(this).parent().parent().css({
                    "display": "none"
                });
                $(this).parent().parent().next().removeClass("col-md-8");
                $(this).parent().parent().next().addClass("col-md-12");
            });

        } else {
            var img =new Image();
            img.src =$(this).attr("src");
            var realWidth =img.width;
            var realHeight =img.height;
            if (realWidth >=800){
                $(this).parent().parent().removeClass("col-md-4");
                $(this).parent().parent().addClass("col-md-8");
                $(this).parent().parent().next().removeClass("col-md-8");
                $(this).parent().parent().next().addClass("col-md-4");
                var cateW = $(this).parent().parent().width();
                if(realHeight/realWidth >1){
                    console.log($(this).parent());
                    $(this).parent().css({
                        'height':cateW*0.7
                    });
                }
                $(this).css({
                    "width": cateW
                });

                $(this).css("display", "block");
            } else {
                var cateW = $(this).parent().parent().width();
                $(this).css({
                    "width": cateW
                });
                $(this).css("display", "block");
            }

        }

    });


};
//判断最新文章模块的span标签是否有字
var checkNull = function () {
    $(".news-img-hover span").each(function () {
        if($(this).text().length >0) {
            $(this).css('display','block');
        }

    });
    $('.news-description p span').each(function () {
        //console.log($(this).text());
        if($(this).text().length >0) {
            $(this).css('display','block');
        }
    });
};
$(function () {
    checkNull();
    setImgWidth();
});
/**
 * 新闻图片宽度处理
 * @type {any}
 */
$(window).resize(function () {
    setImgWidth();
});