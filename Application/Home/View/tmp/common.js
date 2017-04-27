/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2016/12/22-19:22
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */


//设置右下角的的返回顶部是否显示
var setTotop = function () {
    if ($(window).width() < 1170) {
        $('#top').css("display", "none");
    } else {
        $('#top').css("display", "block");
    }
};
//判断是否是PC端，是返回true;否则返回false;
var isPc = function () {
    var userAgentInfo = navigator.userAgent.toLowerCase();
    var Agents = ["android", "iphone", "symbianos", "windows phone", "ipad", "ipod"];
    var flag = true;
    for (var v = 0; v < Agents.length; v++) {
        if (userAgentInfo.indexOf(Agents[v]) >= 0) {
            flag = false;
            break;
        }
    }
    return flag;
};

//判断移动设备是向上滑动还是向下滑动
var handleEvent = function () {
    var startX,startY,endX,endY,moveX,moveY;
    var touch =function (event) {
        var event = event ||window.event;

        switch (event.type) {
            case "touchstart":
                startX = event.changedTouches[0].pageX;
                startY = event.changedTouches[0].pageY;

                break;
            case "touchend":
                //endX = event.changedTouches[0].pageX;
                //endY = event.changedTouches[0].pageY;
                $('.main-navigation').addClass('navbar-fixed-top').removeClass('navbar-transform-top');
                $('body').css('margin-top',$('.main-navigation').height()+'px');
                break;
            case "touchmove":
                //event.preventDefault();
                moveX = event.changedTouches[0].pageX;
                moveY = event.changedTouches[0].pageY;
                var X = moveX-startX;
                var Y = moveY - startY;
                if(Math.abs(Y) >Math.abs(X) && Y>0){
                    $('.main-navigation').addClass('navbar-fixed-top').removeClass('navbar-transform-top');
                    $('body').css('margin-top',$('.main-navigation').height()+'px');

                }else if(Math.abs(Y) >Math.abs(X) && Y<=0){
                    $('.main-navigation').removeClass('navbar-fixed-top').addClass('navbar-transform-top');
                    $('body').css('margin-top',0);
                }
                break;
        }


    };
    document.addEventListener('touchstart',touch, false);
    document.addEventListener('touchmove',touch, false);
    document.addEventListener('touchend',touch, false);

};


/**
 *导航栏fix效果
 * @type {any}
 */
var navSetTop = function () {
    if (!isPc() && $(window).width() <768) {
        handleEvent();

    } else {
        var headerHeight = $('.main-header').height() + $('.main-navigation').height();
        $(window).scroll(function () {

            if ($(window).scrollTop() > headerHeight) {
                $('.main-navigation').addClass('navbar-fixed-top')
                //$('.main-navigation').addClass('navbar-fixed-top').removeClass('navbar-transform-top');


            } else {
                $('.main-navigation').removeClass('navbar-fixed-top');
                //$('.main-navigation').removeClass('navbar-fixed-top').addClass('navbar-transform-top');

            }
        });
    }


};
navSetTop();

$(function () {

    //导航栏点击切换css样式变化
    $('ul.menu li').on({
        'click': function () {
            $(this).addClass('nav-current').siblings().removeClass('nav-current');
        },
        'hover': function () {
            $(this).addClass('nav-current');
        }

    });


    //手机菜单遮罩层显示
    $('#nav-toggle').click(function () {
        $('.base-container').addClass('overlay-open');
        $('#main-menu').addClass('open');
        $('body').addClass('html-no-scroll');

    });
    $('#nav-close').click(function () {
        $('.base-container').removeClass('overlay-open');
        $('#main-menu').removeClass('open');
        $('.main-menu-list').css('display', 'none');
        $('.nav-list').css('display', 'block');
        $('body').removeClass('html-no-scroll');


    });
    $('.md-btn-login-toggle').click(function () {
        $('.login-list').siblings('.nav-list').css('display', 'none');
        $('.login-list').siblings('.register-list').css('display', 'none');
        $('.login-list').fadeIn();
        $('img.verify-image').attr('src', verifyUrl + "?" + Math.random());
    });
    $('.md-btn-register-toggle').click(function () {
        $('.register-list').siblings('.nav-list').css('display', 'none');
        $('.register-list').siblings('.login-list').css('display', 'none');
        $('.register-list').fadeIn();
        $('img.verify-image').attr('src', verifyUrl + "?" + Math.random());
    });


    $('.toggle-member').click(function () {
        $('.dropdown-info').toggle();
        var end = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        $('.dropdown-info').addClass('animated wobble').one(end, function () {
            $(this).removeClass('animated wobble');
        });

    });


    /**
     * 24快报
     */

    $(".title-toggle").click(function () {
        var tagName = $(this).attr("id");
        if ($(this).find(".icon-fade").hasClass("icon-angle-down")) {
            var _this = $(this);
            $(this).parent().next().fadeOut(500, function () {
                _this.parent().next().next().fadeIn(100);
            });
            $(this).find(".icon-fade").removeClass("icon-angle-down");
            $(this).find(".icon-fade").addClass("icon-angle-up");

        } else {
            var _this = $(this);
            $(this).parent().next().next().fadeOut(100, function () {
                _this.parent().next().fadeIn(1000);
            });
            $(this).find(".icon-fade").removeClass("icon-angle-up");
            $(this).find(".icon-fade").addClass("icon-angle-down");

        }
    });
    setTotop();


});

/**
 * 右下角是否显示
 * @type {any}
 */
$(window).resize(function () {
    setTotop();
    navSetTop();
    if ($(window).width() >= 768) {
        $('.main-menu-list').css('display', 'none');
        $('.nav-list').css('display', 'block');
    }

});


if (!(/msie [6|7|8|9]/i.test(navigator.userAgent)) && $(window).width() >= 992) {
    (function () {
        window.scrollReveal = new scrollReveal({reset: true});
    })();
}
var url = window.location.href;
//生成100*100(宽度100，高度100)的二维码
jQuery('.qrcode').qrcode({
    render: "canvas",//也可以替换为table
    width: 100,
    height: 100,
    text: url,
    correctLevel: QRErrorCorrectLevel.M,
    background: "#ffffff",
    foreground: "#6888FF"

});

