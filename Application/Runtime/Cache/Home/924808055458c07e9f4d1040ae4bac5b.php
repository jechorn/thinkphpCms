<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >

    
    <title>分类页</title>



    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/FontAwesome-3.2.1/css/font-awesome.min.css">
    <!--[if IE 7]>
    <link rel="stylesheet" href="/thinkphp/Public/FontAwesome-3.2.1/css/font-awesome-ie7.min.css">
    <![endif]-->
    <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="http://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
    <link href="/thinkphp/Public/css/vender/bootstrap-touch-slider.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/base.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/login.modal.css">
    
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/list.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/sidebar.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/pagination.css">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if Viewview the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="base-container">

    <!-- start header -->
    <header class="main-header">
        <div style="width: 100%;background:#F1554F;">
            <div class="container member-guide">
                <?php if(empty($_SESSION['username'])): ?><div class="member user-login">
                    <span>
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <a href="javascript:void(0);">登录</a>
                    </span>
                        <span>|</span>
                        <span>
                        <i class="fa fa-registered"></i>
                        <a href="javascript:void(0);" data-type="register">注册</a>
                    </span>
                    </div>
                    <?php else: ?>
                    <div class="member toggle-member">
                        <img class="dropdown-member" src="/thinkphp/Public/images/thumb-head.jpg"/>
                        <a><?php echo (session('username')); ?></a>
                        <div class="dropdown-info">
                            <div class="triangle"></div>
                            <ul class="info">
                                <li><a href="#">个人中心</a></li>
                                <li><a href="#">账号设置</a></li>
                                <li><a href="#">退出登录</a></li>
                            </ul>
                        </div>


                    </div><?php endif; ?>

            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 logo-image">
                    <h1 id="logo-title"><?php echo ($system["webname"]); ?></h1>
                    <hr/>
                </div>
                <div class="col-md-12 logo-description">
                    <p class="logo-description"><?php echo ($system["description"]); ?></p>

                </div>
            </div>
        </div>

    </header>
    <!-- end header -->
    <!-- start nav -->
    <nav class="navbar navbar-default main-navigation">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button id="nav-toggle" type="button" class="navbar-toggle" >
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </button>
                        <span>shadow</span>
                    </div>

                    <div class="overlay overlay-content-push" id="main-menu">
                        <div class="md-nav-tile">
                            <span>导航菜单</span>
                            <span id="nav-close" class="nav-close">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </span>
                            <span id="nav-search" class="nav-search">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </span>
                        </div>
                        <div class="nav-list main-menu-list">
                            <ul class="nav-justified menu" role="tablist">
                                <li class="nav-current" role="presentation"><a href="<?php echo U('Index/index');?>" target="_self">首页</a></li>
                                <?php if(is_array($nav)): foreach($nav as $key=>$na): ?><li role="presentation"><a href="<?php echo U('Cate/index',array('id'=>$na['id']));?>" target="_self" data-id="<?php echo ($na["id"]); ?>"><?php echo ($na["name"]); ?></a></li><?php endforeach; endif; ?>
                            </ul>
                            <?php if(empty($_SESSION['username'])): ?><div class="md-login-tile">
                                    <span>登录获取更多的乐趣</span>
                                    <i class="fa  fa-angle-right"></i>
                                </div>
                                <div class="md-btn-login">
                                    <button class="md-btn-login-toggle">登录</button>
                                    <button class="md-btn-register-toggle">注册</button>
                                </div>
                                <?php else: ?>
                                <div class="md-login-tile member-info">
                                    <img class="dropdown-member" src="/thinkphp/Public/images/thumb-head.jpg"/>
                                    <span>欢迎你<?php echo (session('username')); ?></span>
                                    <i class="fa  fa-angle-right"></i>
                                </div>
                                <div class="md-btn-login">
                                    <button class="md-btn-logout-toggle">退出</button>
                                </div><?php endif; ?>

                        </div>
                        <div class="login-list main-menu-list">
                            <span>登录shadow</span>
                            <form class="form-login">
                                <div class="login-content">
                                    <input class="form-control" name="username" type="text" placeholder="用户名/邮箱"
                                               autocomplete="off" required />
                                    <input class="form-control" name="password" type="password" placeholder="输入6-24位密码"
                                               autocomplete="off" required />
                                    <input class="form-control" name="code" type="text" placeholder="验证码"
                                           autocomplete="off" required />
                                    <img class="verify-image" src="<?php echo U('Login/createVerify');?>"
                                         style="width: 150px;height: 40px;overflow: hidden"/>
                                </div>
                                <span class="login-msg"></span>
                                <button class="btn btn-login" type="submit">登 录</button>
                            </form>
                            <a class="md-btn-register-toggle" href="javascript:void(0)">快速注册</a>
                        </div>
                        <div class="register-list main-menu-list">
                            <span>快速注册</span>
                            <form class="form-register">
                                <div class="register-content">
                                    <input class="form-control" name="username" type="text" placeholder="请给自己起一个昵称吧，长度2-10位"
                                           autocomplete="off" required />
                                    <input class="form-control" name="psw" type="password" placeholder="密码长度是6-24位"
                                           autocomplete="off" required />
                                    <input class="form-control" name="repsw" type="password" placeholder="请再次输入密码"
                                           autocomplete="off" required />
                                    <input class="form-control" name="code" type="text" placeholder="请输入验证码"
                                           autocomplete="off" required />
                                    <img class="verify-image" src="<?php echo U('Login/createVerify');?>"
                                         style="width: 150px;height: 40px;overflow: hidden"/>
                                </div>
                                <span class="register-msg"></span>
                                <button class="btn btn-register" type="submit">注册</button>
                            </form>
                            <a class="md-btn-login-toggle" href="javascript:void(0)">快速登录</a>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </nav>
    <!--end nav-->

    

    <!-- start container content-->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="list-margin" style="margin-left: 15px;margin-right: 15px">
                    <div id="cate-show">
                        <?php if(empty($cateArticle)): ?><div data-scroll-reveal class="row list-items">
                                <h4 style="text-align: center">没有找到相应的文章</h4>
                                <p style="text-align: center;margin-top: 15px">点击这里返回<a href="<?php echo U('Index/index');?>">首页</a></p>
                            </div>

                            <?php else: ?>
                            <?php if(is_array($cateArticle)): foreach($cateArticle as $key=>$ca): ?><div data-scroll-reveal class="row list-items">
                                    <div class="col-md-4 list-thumb">
                                        <a class="news-img-hover" title="<?php echo ($ca["title"]); ?>" href="<?php echo U('Details/detail',array('id'=>$ca['id']));?>" target="_blank">
                                            <img src="<?php echo ($ca["image"]); ?>"/>
                                            <span class="mod-hot"><?php echo ($ca['Attr'][0]['name']); ?></span>
                                        </a>
                                    </div>
                                    <div class="col-md-8 list-detail">
                                        <h4>
                                            <a href="<?php echo U('Details/detail',array('id'=>$ca['id']));?>" target="_blank" title="<?php echo ($ca["title"]); ?>"><?php echo ($ca["title"]); ?></a>
                                        </h4>
                                        <div class="news-tags-and-time">
                                            <span class="news-time"><?php echo ($ca["createtime"]); ?></span>
                                            <?php if(is_array($ca['tags'])): foreach($ca['tags'] as $key=>$tags): ?><a href="<?php echo U('Index/tags',array('tags'=>urlencode($tags)));?>" target="_blank" title="<?php echo ($tags); ?>"><?php echo ($tags); ?></a><?php endforeach; endif; ?>

                                            <span class="news-time">阅 <?php echo ($ca["click"]); ?></span>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="list-description">
                                            <p><?php echo ($ca["content"]); ?><a href="<?php echo U('Details/detail',array('id'=>$ca['id']));?>">查看全文>></a></p>
                                        </div>


                                    </div>

                                </div><?php endforeach; endif; endif; ?>
                    </div>


                    <!--start分页-->
                    <div class="page row">
                        <span id="cate-cid" cid="<?php echo ($cid); ?>" style="display: none"></span>
                        <div class="M-box col-md-12">

                            <!--<div class="clearfix"></div>-->
                        </div>
                    </div>
                    <!--end分页-->

                </div>

            </div>

            <div class="col-md-4">
                <div class="list-margin" style="padding-right: 10px;padding-left: 10px;background: #ffffff">
                    <div data-scroll-reveal class="search-keyword">
                        <form action="" method="post">
                            <input class="keyword-search form-control" name="keyword" type="text" value=""
                                   placeholder="请输入关键词"/>
                            <input class="submit-btn" type="submit" value=""/>
                        </form>
                    </div>
                    <hr/>
                    <div data-scroll-reveal class="rand-hot-news">
                        <span class="change-item"><i class="fa fa-refresh" aria-hidden="true"  style="float:right;"></i>换一批</span>
                        <h4>随机热文</h4>
                        <ul class="rand-items">
                            <?php if(is_array($randArticle)): foreach($randArticle as $index=>$ra): ?><li class="rand-news-list">
                                    <a href="<?php echo U('Details/detail',array('id'=>$ra['id']));?>" target="_blank"
                                       title="<?php echo ($ra["title"]); ?>"><span><?php echo ($index+1); ?></span><?php echo ($ra["title"]); ?></a>
                                </li><?php endforeach; endif; ?>
                        </ul>
                    </div>
                    <div class="hot-tags">
                        <h4>图文热文</h4>
                        <div class="list-for-hot">
                            <ul>
                                <?php if(is_array($hotArticle)): foreach($hotArticle as $key=>$ho): ?><li data-scroll-reveal>
                                        <div class="list-article-img">
                                            <a href="<?php echo U('Details/detail',array('id'=>$ho['id']));?>" title="" target="_blank">
                                                <img src="<?php echo ($ho["image"]); ?>">
                                            </a>
                                        </div>
                                        <a class="list-title" href="<?php echo U('Details/detail',array('id'=>$ho['id']));?>" target="_blank" title="<?php echo ($ho["title"]); ?>">
                                            <?php echo ($ho["title"]); ?>
                                        </a>
                                    </li><?php endforeach; endif; ?>
                            </ul>

                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--end container content-->



    <!--start footer  -->
    <div class="container-fluid footer" data-scroll-reveal>
        <div class="container">
            <div class="row footer-content">
                <div class="col-md-4 img-footer">
                    <img src="/thinkphp/Uploads/<?php echo ($system["image"]); ?>"/>
                </div>
                <div class="col-md-4 friend_link">
                    <p>友情链接：</p>
                    <?php if(is_array($link)): foreach($link as $key=>$li): ?><a href="<?php echo ($li["url"]); ?>" target="_blank" title="<?php echo ($li["name"]); ?>"><?php echo ($li["name"]); ?></a><?php endforeach; endif; ?>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-4 copyright">
                    <p>关于我们 | jechorn@163.com 版权所有 </p>
                    <P>备案号： <?php echo ($system["icp"]); ?> </p>
                    <p>Powered by jechorn</p>
                    <p> <?php echo ($system["copyright"]); ?></P>
                </div>
            </div>

        </div>
    </div>
    <!--end footer  -->

    <!--start scroll to top-->
    <div id="top" style="display: none">
        <div id="izl_rmenu" class="izl-rmenu">

            <div class="btn btn-qq">
                <i class="fa fa-qq"></i>
                <span>在线客服</span>
            </div>

            <div class="btn btn-phone">
                <i class="fa fa-mobile"></i>
                <span>手机访问</span>
                <div class="pic-container">
                    <div id="qrcode" class="pic qrcode" onclick="window.location.href=''"></div>
                    <div class="triangle"></div>
                </div>

            </div>
            <div class="btn btn-email">
                <i class="fa fa-envelope-o"></i>
                <span>Email</span>
                <div class="email">jechorn@163.com</div>
            </div>
            <div class="btn btn-top">
                <i class="fa fa-angle-up"></i>
                <span>返回顶部</span>
            </div>
        </div>
    </div>
    <!--end scroll to top-->

    <!-- login-Modal-start -->
    <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="login-module">
                        <div class="login-title">
                            <i class="fa fa-times close" aria-hidden="true" data-dismiss="modal"></i>
                            <span class="title-text">用户登录</span>
                        </div>
                        <form class="form-login">
                            <div class="login-content">
                                <input class="form-control" name="username" type="text" placeholder="用户名/邮箱"
                                       autocomplete="off" required />
                                <input class="form-control" name="password" type="password" placeholder="输入6-24位密码"
                                       autocomplete="off" required />
                                <div class="input-group">
                                    <input class="form-control" name="code" type="text" placeholder="验证码"
                                           autocomplete="off" required />
                                    <img class="verify-image" src="<?php echo U('Login/createVerify');?>"
                                         style="width: 150px;height: 40px;overflow: hidden"/>
                                </div>
                            </div>
                            <span class="login-msg"></span>
                            <button class="btn btn-login" type="submit">登 录</button>
                        </form>
                        <div class="href-style">
                            <a class="href-register" href="javascript:void(0);">快速注册</a>
                        </div>


                        <div class="third-login">
                            <div class="third-title">
                                <span>第三方登录</span>
                            </div>
                            <a href=""><i class="fa fa-qq fa-login"></i></a>
                            <a href=""><i class="fa fa-weixin fa-login"></i></a>
                        </div>
                    </div>
                    <div class="register-module">
                        <div class="register-title">
                            <i class="fa fa-times close" aria-hidden="true" data-dismiss="modal"></i>
                            <span class="title-text">用户注册</span>
                        </div>
                        <form id="form-register">
                            <div class="register-content">
                                <div class="input-group">
                                    <label class="input-group-addon" for="username">用&nbsp;&nbsp;户&nbsp;名</label>
                                    <input class="form-control" id="username" name="username" type="text"
                                           placeholder="请给自己起一个昵称吧，长度2-10位" autocomplete="off" required/>
                                </div>
                                <div class="input-group">
                                    <label class="input-group-addon"
                                           for="psw">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                                    <input class="form-control" id="psw" name="psw" type="password"
                                           placeholder="密码长度是6-24位" autocomplete="off" required />
                                </div>
                                <div class="input-group">
                                    <label class="input-group-addon" for="comfirm">确认密码</label>
                                    <input class="form-control" id="comfirm" name="repsw" type="password"
                                           placeholder="请确定输入密码一致" autocomplete="off" required/>
                                </div>
                                <div class="input-group">
                                    <label class="input-group-addon" for="verify-code">验&nbsp;&nbsp;证&nbsp;码</label>
                                    <div class="verify-code-group">
                                        <input class="form-control" id="verify-code" name="code" type="text"
                                               placeholder="请输入验证码" autocomplete="off" required />
                                        <img class="verify-image" src="<?php echo U('Login/createVerify');?>"
                                             style="width: 150px;height: 40px;overflow: hidden"/>
                                    </div>
                                </div>
                            </div>
                            <span class="register-msg"></span>
                            <button class="btn btn-register" type="submit">注 册</button>
                        </form>
                        <div class="href-style">
                            <a class="href-login" href="javascript:void(0);">快速登录</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login-Modal-end -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/thinkphp/Public/bootstrap/js/bootstrap.min.js"></script>

    <script src="/thinkphp/Public/js/vender/jquery.pagination.js"></script>
    <script src="/thinkphp/Public/js/vender/jquery.animatescroll.js"></script>

<script src="/thinkphp/Public/js/vender/scrollreveal.js"></script>
<script src="/thinkphp/Public/js/scrolltotop.js"></script>
<script src="/thinkphp/Public/js/vender/qrcode.js"></script>
<script src="/thinkphp/Public/js/vender/jquery.qrcode.js"></script>
<script src="/thinkphp/Public/js/common.js"></script>
<script>
    //生成验证码的方法地址
    var verifyUrl = "<?php echo U('Login/createVerify');?>";
    //登录方法地址
    var loginUrl = '<?php echo U("Login/login");?>';
    //注册方法地址
    var registerUrl = '<?php echo U("Login/register");?>';

</script>


    <script>
        if(<?php echo ($pagenumber); ?> >0){
            $('.M-box').pagination({
                pageCount: <?php echo ($pagenumber); ?>,
                jump: true,
                coping: true,
                homePage: '首页',
                endPage: '末页',
                prevContent: '上页',
                nextContent: '下页',
                callback: function (api) {
                    var pageNum = api.getCurrent();
                    var cid =$('#cate-cid').attr('cid');
                    var pageTotal = api.getTotalPage();
                    $.ajax({
                        type :"POST",
                        data :{currey:pageNum,cid:cid},
                        dataType:"json",
                        url:"<?php echo U('Cate/ajaxHandle');?>",
                        success:function (res) {
                            var html = '';
                            $.each(res,function (index,list) {
                                var url ="<?php echo U('Details/detail');?>"+"?id="+list.id;
                                html +='<div data-scroll-reveal class="row list-items">';
                                html += '<div class="col-md-4 list-thumb">';
                                html += '<a class="news-img-hover" title="" href="'+url+'" target="_blank">';
                                html += '<img src="'+list.image+'"/>';
                                var attrName = '';
                                if(list.Attr.length >0){
                                    attrName = list.Attr[0].name;
                                    console.log(attrName);
                                }
                                html += '<span class="mod-hot">'+attrName+'</span>';
                                html += '</a>';
                                html += '</div>';
                                html += '<div class="col-md-8 list-detail">';
                                html += '<h4>';
                                html += '<a href="'+url+'" target="_blank" title="'+list.title+'">'+list.title+'</a>';
                                html += '</h4>';
                                html += '<div class="news-tags-and-time">';
                                html += '<span class="news-time">'+list.createtime+'</span>';
                                $.each(list.tags,function (key,value) {
                                    var urlTags ="<?php echo U('Index/tags');?>"+"?tags="+value;
                                    html += '<a href="'+urlTags+'" target="_blank" title="'+value+'">'+value+'</a>';
                                });
                                html += '<span class="news-time">阅 '+list.click+'</span>';
                                html += '<div class="clearfix"></div>';
                                html += '</div>';
                                html += '<div class="list-description">';
                                html += '<p>'+list.content+'<a href="'+url+'">查看全文>></a></p>';
                                html += '</div>';
                                html += '</div>';
                                html += '</div>';

                            });

                            $('#cate-show').empty().html(html);
                            /*$('.list-thumb').removeClass('col-md-8').addClass('col-md-4');
                             $('.news-img-hover img').css({
                             'width' :'100%',
                             'display':'block'
                             });*/
                            $('#cate-show').animatescroll({scrollSpeed:2000,easing:'easeOutBounce'});

                        }

                    });
                }
            });
        }

        $('#tags-name a').each(function () {
            $(this).css({
                "margin-right": Math.random() * 10
            });

        });
        /*$('.list-thumb').removeClass('col-md-8').addClass('col-md-4');
         $('.news-img-hover img').css({
         'width' :'100%',
         'display':'block'
         });*/
    </script>
    <script>
        //随机热文ajax返回
        $('.change-item').click(function () {
            $.ajax({
                type: 'POST',
                url: '<?php echo U("Cate/randArticle");?>',
                dataType: 'json',
                success: function (res) {
                    if(res.state ==1) {
                        $('.rand-items').empty();
                        var html = '' ;
                        $.each(res.randArticle,function (index,value) {
                            var url ='<?php echo U("Details/detail");?>'+'?id='+value.id;
                            html += '<li class="rand-news-list">';
                            html +=  '<a href="'+url+'" target="_blank" title="'+value.title+'"><span>'+(index+1)+'</span>'+value.title+'</a>';
                            html += '</li>';

                        });
                        $('.rand-items').html(html);

                    }
                }

            });
        });

    </script>
    <script>
        //导航菜单的样式切换
        <?php if(!empty($cid)) echo 'var cid = '.$cid.';';else echo 'var cid = "";'; ?>

        var currentAction ='<?php echo (ACTION_NAME); ?>';
        currentAction =currentAction.toLowerCase();
        switch (currentAction) {
            case 'index':
                $('ul.menu li a').each(function () {
                    var _this =$(this);
                    if($(this).attr('data-id') == cid){

                        _this.parent().addClass('nav-current').siblings().removeClass('nav-current');
                    }

                });
                break;
            default:
                $('ul.menu li:eq(0)').addClass('nav-current').siblings().removeClass('nav-current');

        }

    </script>

<script src="/thinkphp/Public/js/login.modal.js"></script>
<!--登录注册表单提交-->
<script src="/thinkphp/Public/js/form.submit.js"></script>

</body>
</html>