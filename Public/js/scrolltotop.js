/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2016/12/26-16:30
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */
$(function () {

    $('#izl_rmenu').find(".btn-top").click(function () {
        $("html, body").animate({
            "scroll-top": 0
        }, "fast");
    });

    var lastRmenuStatus = false;
    $(window).scroll(function () {//bug
        var _top = $(window).scrollTop();
        if (_top > 200) {
            $("#izl_rmenu").data("expanded", true);
        } else {
            $("#izl_rmenu").data("expanded", false);
        }
        if ($("#izl_rmenu").data("expanded") != lastRmenuStatus) {
            lastRmenuStatus = $("#izl_rmenu").data("expanded");
            if (lastRmenuStatus) {
                $("#izl_rmenu .btn-top").slideDown();
            } else {
                $("#izl_rmenu .btn-top").slideUp();
            }
        }
    });
});