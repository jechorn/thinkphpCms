/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2017/1/17-6:38
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */
$(function () {
    /**
     *
     * @param url  ajax提交的地址
     * @param data  提交的数据json
     * @param element 添加子节点的父级元素
     */
    function carouselHandle(url,data,element) {
            $.ajax({
                url:url,
                method:'post',
                data:data,
                dataType:'json',
                beforeSend:function () {

                },
                success:function (res) {
                    element.append('<div class="pop-up" ><div class="pop-up-msg">'+res.msg+'</div><div class="triangle"></div></div>');
                    $('.pop-up').fadeIn(500,function () {
                        setTimeout(function () {
                            $('.pop-up').fadeOut(500,function () {
                                $('.pop-up').remove();
                                if(res.status==1){
                                    location.reload();

                                }
                            });
                        },1500);
                    });

                }

            });

    }
    function getData(element) {
        var cid = element.parent().attr('cid');
        var status = element.parent().attr('status');
        var data = {cid:cid,status:status};
        return data;
    }


    $('.btn-update').bind('click',function () {
        var _this = $(this);
        var data = getData(_this);
        carouselHandle(updateStatus,data,_this);

    });
    $('.btn-delete').bind('click',function () {
        var _this = $(this);
        var data = getData(_this);
        carouselHandle(deleteCarousel,data,_this);

    });



});