/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2017/1/13-13:11
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */

function systemForms() {
    var html = "<div class='alert-msg' style='display: none'><div class='up'></div><div class='msg-show'></div></div>";
    $('#system-form .alert-msg').remove();

    //信息提示
    var showMsg = function (element, msg) {
        var _this = $(element);
        _this.after(html);
        _this.next().find('.msg-show').text(msg);
        _this.focus();
        _this.next().fadeIn(500, function () {
            setTimeout(function () {
                _this.next().fadeOut(500, function () {
                    _this.next().remove();
                })
            }, 1500);
        });
    };

    //检查是否为空
    var checkEmpty = function (element, msg) {
        if (element.val().trim() == '' || element.val().trim() == null) {
            showMsg(element, msg);
            return true;

        }
        return false;
    };

    //检查输入的长度
    var checkLength = function (element, minLen, maxLen) {
        if (element.val().trim().length < minLen) {
            showMsg(element, '长度不能小于' + minLen);
            return true;
        }
        if (element.val().trim().length > maxLen) {
            showMsg(element, '长度不能大于' + maxLen);
            return true;
        }
        return false;
    };
    if (checkEmpty($('#webname'), '不能为空')) {
        return false;
    }

    if (checkLength($('#webname'), 3, 10)) {
        return false;
    }
    if (checkEmpty($('#keywords'), '不能为空')) {
        return false;
    }
    if (checkLength($('#keywords'), 5, 100)) {
        return false;
    }
    if (checkEmpty($('#icp'), '不能为空')) {
        return false;
    }
    if (checkLength($('#icp'), 5, 20)) {
        return false;
    }
    if (checkEmpty($('#copyright'), '不能为空')) {
        return false;
    }
    if (checkLength($('#copyright'), 10, 50)) {
        return false;
    }
    if (checkEmpty($('#description'), '不能为空')) {
        var textareaH = $('#description').parent().height();
        $('.alert-msg').css({
            'top': textareaH + 'px'
        });
        return false;
    }
    if (checkLength($('#description'), 10, 150)) {
        var textareaH = $('#description').parent().height();
        $('.alert-msg').css({
            'top': textareaH + 'px'
        });
        return false;
    }
    if ($('#inputImage').val().trim() == '') {

        showMsg($('#inputImage'), '请上传图片');

        return false;
    }
    var webname = $('#webname').val().trim();
    var keywords = $('#keywords').val().trim();
    var icp = $('#icp').val().trim();
    var copyright = $('#copyright').val().trim();
    var description = $('#description').val().trim();
    var image = $('#inputImage').val().trim();
    var cropper = $('#putData').val().trim();
    var data = new FormData($('#system-form')[0]);
    JSON.stringify(data);

/*    var data = {
        webname: webname,
        keywords: keywords,
        icp: icp,
        copyright: copyright,
        description: description,
        image: image,
        cropper:cropper
    };*/
    console.log(data);

    x0p({
        title: '是否要更改系统设置？',
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
                url:systemForm,
                type:'post',
                dataType:'json',
                data:data,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend:function () {

                },
                success:function (res) {

                    if(res.state == 1){
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
                }

            });

        }
    });

    return false;
}
