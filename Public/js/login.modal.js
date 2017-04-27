/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2017/4/19-5:31
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */

$(function () {
    var end = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

    //登录模态框显示
    $('.user-login span a').click(function () {
        if($(window).width() <= 768){
            $('.base-container').addClass('overlay-open');
            $('#main-menu').addClass('open');
            $('body').addClass('html-no-scroll');
            return false;
        }

        if($(this).attr('data-type') == 'register'){
            $('.login-module').css('display', 'none');
            $('.register-module').css('display', 'block');
        }
        $('#login-modal').modal('show');
        $('.modal-content').addClass('animated zoomIn').one(end, function () {
            $(this).removeClass('animated zoomIn');
        });
    });
    //登录模块切换到注册模块
    $('.href-register').click(function () {
        $('.login-module').addClass('animated zoomOut').one(end, function () {
            $(this).css('display', 'none');
            $(this).removeClass('animated zoomOut');
            $('.register-module').css('display', 'block');
            $('.register-module').addClass('animated bounceInDown').one(end, function () {
                $(this).removeClass('animated bounceInDown');
            });
        });
        $('img.verify-image').attr('src', verifyUrl + "?" + Math.random());
    });
    //注册模块切换到登录模块
    $('.href-login').click(function () {
        $('.register-module').addClass('animated zoomOut').one(end, function () {
            $(this).css('display', 'none');
            $(this).removeClass('animated zoomOut');
            $('.login-module').css('display', 'block');
            $('.login-module').addClass('animated bounceInDown').one(end, function () {
                $(this).removeClass('animated bounceInDown');
            });
        });
        $('img.verify-image').attr('src', verifyUrl + "?" + Math.random());

    });

    //登录注册验证码刷新
    $('img.verify-image').click(function () {
        $('img.verify-image').attr('src', verifyUrl + "?" + Math.random());
        //this.src = verifyUrl+"?"+Math.random();
    });

});