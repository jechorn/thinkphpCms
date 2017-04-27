/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2017/1/1-11:58
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */
$(document).ready(function () {
    $(".carousel-attr>input[type='text']").on({
        blur: function () {
            if ($(this).val().trim() == '') {
                $(this).parent().parent().find('span').remove();
                $(this).parent().parent().append("<span>（*）不能为空!</span>");
            }else {
                $(this).parent().parent().find('span').remove();
            }
        }
    });


});
function ajaxUploadBtn() {
    var num = 0;
    $("#carousel_info input").each(function () {
        if ($(this).val().trim() == '') {
            $(this).parent().parent().find('span').remove();
            $(this).parent().parent().append("<span>（*）不能为空!</span>");
            $(this).focus();
            num++;
            return false;
        }
    });
    if (num > 0) {
        return false;
    } else {
        var data = new FormData($('#carousel_info')[0]);
        console.log(data);

    /*    $.ajax({
            url: addCarouse,
            type: 'POST',
            data: data,
            dataType: 'JSON',
            cache: false,
            processData: false,
            contentType: false,
            beforeSend:function () {
                $('#btn-upload').text('正在提交');
            },
            success:function(res){
                if(res.status ==200){
                    $('#submit-msg').modal('show');
                    $('#btn-upload').text('提交');

                    $('#submit-msg .response-msg').html('<span class="glyphicon glyphicon-ok"></span><h4>'+res.msg +'</h4>');
                    if(res.msg !=='信息添加成功！'){
                        $('#submit-msg .response-msg span').removeClass('glyphicon-ok').addClass('glyphicon-remove');

                    }else{
                        setTimeout(function () {
                            location.reload();
                        },2000);
                    }

                }
            }
        });*/

        x0p({
            title: '是否要添加这个轮播图？',
            text: null,
            icon: 'info',
            animationType: 'pop',
            buttons: [
                {
                    type: 'cancel',
                    text: '取消'
                },
                {
                    type: 'info',
                    text: '确定',
                    showLoading: true
                }
            ]
        }, function(button) {
            if(button == 'info') {

                $.ajax({
                    url:addCarouse,
                    type:'post',
                    dataType:'json',
                    data:data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    beforeSend:function () {

                    },
                    success:function (res) {

                        if(res.status == 1){
                            x0p(res.msg, null, 'ok', false);
                            $('#x0p-button-0').click(function () {

                                window.location.href = hrefUrl;

                            });


                        }else {
                            x0p(res.msg, null, 'error', false);
                        }


                    },
                    error:function (res) {

                        x0p('数据连接失败，请重新刷新', null, 'error', false);
                    },
                    complete:function () {

                    }

                });

            }
        });





        return false;

    }



}

