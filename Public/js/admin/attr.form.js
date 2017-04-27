/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2017/1/18-19:01
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */

function attrVerify() {
    var num = 0;
    $('#attr-form input').each(function () {
        if ($(this).val().trim() == '') {
            $('.alert-msg').remove();
            $(this).parent().append('<div class="alert-msg" style="display: none"><div class="up"></div><div class="msg-show">不能为空</div> </div>');
            $(this).parent().find('.alert-msg').fadeIn(1000);
            num++
            return false;
        }else{
            if($(this).val().trim().length <2 || $(this).val().trim().length >7){
                $('.alert-msg').remove();
                $(this).parent().append('<div class="alert-msg" style="display: none"><div class="up"></div><div class="msg-show">字符必须在2-7字符之间</div> </div>');
                $(this).parent().find('.alert-msg').fadeIn(1000);
                num++
                return false;
            }
        }

    });
    setTimeout(function () {
        $('.alert-msg').fadeOut(1500);
    },3000);
    return num > 0 ? false : true;
}


