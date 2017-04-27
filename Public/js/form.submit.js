/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description: 前台注册登录form表单ajax提交
 | CreateTime : 2017/4/15-6:12
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */

//前台注册登录form表单ajax提交
$(function () {
    var end = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    $('.form-login').submit(function(e){
        e.preventDefault();
    });
    $('#form-register').submit(function(e){
        e.preventDefault();
    });
    var msgTips = function (element,msg,state) {
        element.text(msg);
        element.css('display','block');
        element.addClass('animated fadeInDown').one(end, function () {
            $(this).removeClass('animated fadeInDown');
            $(this).css('display','none');
            if(state === 1){
                location.reload();
            }
        });
    };
    var isEmpty =function (element,ele,msg,state) {
        var value = element.val().trim();
        if( value === '' || value === null){
            msgTips(ele,msg,state);
            return false;
        }
        return true;
    };
    var checkLength =function (element,ele,minL,maxL,msg,state) {
        var len = element.val().trim().length
        if(len < minL ||len > maxL){
            msgTips(ele,msg,state);
            return false;
        }
        return true;

    };

    $('.btn-register').click(function () {
        var _this = $(this).parent();
        if(!isEmpty(_this.find('input[name="username"]'),_this.find('.register-msg'),'用户名不能为空',2)) return false;
        if(!checkLength(_this.find('input[name="username"]'),_this.find('.register-msg'),2,10,'用户名长度必须在2-10之间',2)) return false;
        if(!isEmpty(_this.find('input[name="psw"]'),_this.find('.register-msg'),'密码不能为空',2)) return false;
        if(!checkLength(_this.find('input[name="psw"]'),_this.find('.register-msg'),6,24,'密码长度必须在6-24之间',2)) return false;
        var psw = _this.find('input[name="psw"]').val().trim();
        var repsw = _this.find('input[name="repsw"]').val().trim();
        if(psw !== repsw){
            msgTips(_this.find('.register-msg'),'两次输入的密码不一致',2);
            return false;
        }
        if(!isEmpty(_this.find('input[name="code"]'),_this.find('.register-msg'),'验证码不能为空',2)) return false;


        var data = new FormData(_this[0]);
        $.ajax({
            'type': 'post',
            'data': data,
            'dataType':'json',
            'url': registerUrl,
            'cache' :false,
            processData: false,
            contentType: false,
            beforeSend:function () {
                $('.btn-register').text('正在注册');

            },
            success:function (res) {
                if(res.state === 1){
                    msgTips(_this.find('.register-msg'),res.msg,res.state);

                }else{
                    msgTips(_this.find('.register-msg'),res.msg,res.state);
                }
            },
            error:function () {
                msgTips(_this.find('.register-msg'),'请重新尝试',2);
            },
            complete:function () {
                $('.btn-register').text('注册');
            }

        });
        return false;
    });

    $('.btn-login').click(function () {
        var _this = $(this).parent();
        if(!isEmpty(_this.find('input[name="username"]'),_this.find('.login-msg'),'用户名/邮箱不能为空',2)) return false;
        if(!isEmpty(_this.find('input[name="username"]'),_this.find('.login-msg'),'密码不能为空',2)) return false;
        if(!checkLength(_this.find('input[name="password"]'),_this.find('.login-msg'),6,24,'密码长度必须在6-24之间',2)) return false;
        if(!isEmpty(_this.find('input[name="code"]'),_this.find('.login-msg'),'验证码不能为空',2)) return false;

        var data = new FormData(_this[0]);
        $.ajax({
            'type': 'post',
            'data': data,
            'dataType':'json',
            'url': loginUrl,
            'cache' :false,
            processData: false,
            contentType: false,
            beforeSend:function () {
                $('.btn-login').text('正在登录');
            },
            success:function (res) {
                if(res.state === 1){
                    msgTips(_this.find('.login-msg'),res.msg,res.state);
                }else{
                    msgTips(_this.find('.login-msg'),res.msg,res.state);
                }

            },
            error:function () {
                msgTips(_this.find('.login-msg'),'请重新尝试',2);
            },
            complete:function () {
                $('.btn-login').text('登 录');
            }

        });
        return false;
    });
});