/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2017/1/19-0:48
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */
$(function () {
    $('.btn-delete').bind('click',function () {
        var _this =$(this);
        var cid = $(this).parent().attr('cid');
        var data = {cid:cid};
        var showMsg = function (element,msg) {
                element.append('<div class="pop-up"><div class="pop-up-msg">'+msg+'</div><div class="triangle"></div></div>');
                $('.pop-up').fadeIn(500,function () {
                    setTimeout(function () {
                        $('.pop-up').fadeOut(500,function () {
                            $('.pop-up').remove();
                            location.reload();
                        });
                    },1500);
                });
        };

        $.ajax({
            url:attrDelete,
            type:'post',
            dataType:'JSON',
            data:data,
            beforeSend:function () {
                $('.btn-delete').attr('disabled','disabled');
            },
            success:function (res) {

                showMsg(_this,res.msg);

            },
            error:function () {
                showMsg(_this,'数据连接失败');
            }
        });

    });
});