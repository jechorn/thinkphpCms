/**===============================================================
 | Author     :  "王志传"
 | Author URL :  http://www.jechorn.cn
 |
 | Email      : <jechorn@163.com>
 | Description:
 | CreateTime : 2017/1/22-6:45
 |
 | Copyright (c) 2016-2019, www.jechorn.cn. All Rights Reserved.
 ================================================================== */
function articleAdd() {
    var num = 0 ;
    var articleName =  $('#article-name');
    var articleTags =  $('#article-tags');
    var articleClick  = $('#article-click');
    var nullMsg = '不能为空';

    //检查是否为空
    var checkNull =function (element,msg) {
        if(element.val().trim() == ''){
            showMsg(element,msg);
            num++;
            return false;
        }
        return true;
    };

    //长度检查
    var checkLength =function (element,minLength,maxLength,msg) {
        if(element.val().trim() !== ''){
            if(element.val().trim().length <=minLength || element.val().trim().length >= maxLength){
                showMsg(element,msg);
                num++;
                return false;
            }
        }
        return true;
    }
    //信息提示
    var showMsg =function (element,msg) {
        $('.pop-up').remove();
        element.after('<div class="pop-up" style="left: 50%"><div class="pop-up-msg">'+ msg+'</div><div class="triangle"></div></div>');

        $('.pop-up').fadeIn(1500);
        element.focus();
        setTimeout(function () {
            $('.pop-up').fadeOut(1500);
        },3500);
    };


    if(checkNull(articleName,nullMsg)) {
        if(checkLength(articleName,10,30,'长度必须在10-30个字符之间')) {
            if(checkNull(articleTags,nullMsg)){
                if(checkNull(articleClick,nullMsg)){
                    if(!(/^(\+|-)?\d+$/.test(articleClick.val())) || articleClick.val() <= 0){

                        num++;
                        showMsg(articleClick,'必须输入正整数');

                    }else{

                        if(!ue.hasContents()){
                            num++;
                            x0p('该文章尚没有内容！', null, 'error', false);
                            //showMsg($('#filer_input'),'该文章尚没有内容！')

                        }


                    }

                }

            }
        }

    }


    //return num > 0 ? false : true;
    if(num > 0 ){
        return false;
    }else{
        var data = new FormData($('#article-add')[0]);
        /*
        var aName = $('#article-name').val().trim();
        var aTags = $('#article-tags').val().trim();
        var attrList = new Array();
        $('.checkbox-attr:checked').each(function () {
            attrList.push($(this).val());
        });
        var aAttr = attrList;
        var aClick = $('#article-click').val().trim();
        var aCate = $('#article-cate').val().trim();
        var aImage = $('#filer_input').val().trim();
        var content  = ue.getContent();
        var data = {
            title : aName,
            tags  : aTags,
            cid   : aCate,
            click : aClick,
            content : content,
            image : aImage

        }
        if(aAttr.length > 0){
            data.attr = aAttr;
        }
        */

        var confirmMsg = function (state,msg) {
            x0p(msg, null, state, false);
            $('#x0p-button-0').click(function () {
                if(state=='ok'){
                    window.location.href = hrefUrl;
                }

            });
        };
        var info = {};
        var getAction =function (name) {

            switch (name){

                case "add":
                     info.title = "你确定要添加这篇文章吗？";
                     info.url = handleUrl;
                     return info;

                    break;
                case "update":
                    info.title = "你确定要修改这篇文章吗？";
                    info.url = handleUrl;
                    //data.id = $('#article-id').val();
                    return info;
                    break;
                default:
                    info.title = "你确定要添加这篇文章吗？";
                    info.url = handleUrl;
                    return info;
                    break;

            }
        };
        var information = getAction(actionName);


        x0p({
            title: information.title,
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
                    url:information.url,
                    type:'post',
                    dataType:'json',
                    data:data,
                    //async:true,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success:function (response) {
                        console.log(response.state);

                        if(response.state == 'ok'){
                            confirmMsg(response.state,response.msg);


                        }else {
                            confirmMsg(response.state,response.msg);
                        }

                    },
                    error:function (response) {
                        console.log(response.state);


                        x0p('数据连接失败，请重新刷新', null, 'error', false);
                    }

                });

            }
        });
        return false;

    }



}
