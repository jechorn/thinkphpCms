/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description: 对输入内容的验证
 | CreateTime : 2017/1/8-19:33
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */

$(document).ready(function () {
    $('.not-null').on({
        blur:function () {
            if ($(this).val().trim() == '') {
                var _this = $(this);
                $(this).parent().find('.alert-msg').css({
                    'display': 'block',
                });
                $(this).parent().find('.msg-show').text('不能为空');
                setTimeout(function () {
                    _this.parent().find('.alert-msg').fadeOut(500)
                },1000);


            }
        },
        change:function () {
            if ($(this).val().trim() !== ''){
                $(this).parent().find('.input-correct').css({
                    'display' : 'block'
                });
            }else{
                $(this).parent().find('.input-correct').css({
                    'display' : 'none'
                });
            }
        },
        focus: function () {
            $(this).parent().find('.alert-msg').css({
                'display':'none'
            });
        }
    });
    $('.is-number').on({
        blur:function () {
            var isNumber = $(this).val().trim();
            if(isNumber!== ''){
                if(!$.isNumeric(isNumber)){
                    $(this).parent().find('.alert-msg').css({
                        'display':'block'
                    });
                    $(this).parent().find('.msg-show').text('请输入有效数字');
                }else if($.isNumeric(isNumber) && isNumber>255){
                    $(this).parent().find('.alert-msg').css({
                        'display':'block'
                    });
                    $(this).parent().find('.msg-show').text('数字不能超过255');
                }
            }
        },
        change:function () {
            if ($(this).val().trim() !== '' && $.isNumeric($(this).val().trim()) && $(this).val().trim() <=255){
                $(this).parent().find('.input-correct').css({
                    'display' : 'block'
                });
            }else{
                $(this).parent().find('.input-correct').css({
                    'display' : 'none'
                });
            }
        },
        focus: function () {
            $(this).parent().find('.alert-msg').css({
                'display':'none'
            });
        }
    });

});


function addCate() {
    var num =0;
    $('.input-data input').each(function () {
        if($(this).val().trim()==''){
            $(this).parent().find('.alert-msg').css({
                'display': 'block',
            });
            var _this = ($(this).parent());
            $(this).parent().find('.msg-show').text('不能为空');
            setTimeout(function () {
                $(_this).find('.msg-show').text('');
                $(_this).find('.alert-msg').css({
                    'display': 'none',
                });

            }, 3000);
            num++;
            return false;
        }
    });
    var isNumber = $('.is-number').val().trim();
    if(isNumber!== ''){
        if(!$.isNumeric(isNumber)){
            $(this).parent().find('.alert-msg').css({
                'display':'block'
            });
            $(this).parent().find('.msg-show').text('请输入有效数字');
            num++
        }else if($.isNumeric(isNumber) && isNumber>255){
            $(this).parent().find('.alert-msg').css({
                'display':'block'
            });
            $(this).parent().find('.msg-show').text('数字不能超过255');
            num++
        }
    }


    if(num >0){
        return false;
    }else {
        var cateName =$('#category_name').val().trim();
        var cateSort =$('#category_sort').val().trim();
        var catePid = $('#category_pid').val().trim();
        var cateData = {name:cateName,sort:cateSort,pid:catePid};


        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: cateData,
            dataType: 'json',
            beforeSend:function () {
               $('#btn-upload').text('正在提交中....');
                $('#btn-upload').attr('disabled','disabled');
            },
            success:function(res){
                console.log(res);
                if(res.status==1){
                    x0p(res.msg, null, 'ok', false);
                    $('#x0p-button-0').click(function () {

                        window.location.href = res.url;

                    });
                }else{
                    x0p(res.msg, null, 'error', false);
                }
            },
            error:function (res) {
                x0p('数据连接失败，请重新再试', null, 'error', false);
            },
            complete:function () {
                $('#btn-upload').text('提交');
                $('#btn-upload').removeAttr('disabled');
            }
        });
        return false;
    }

}

