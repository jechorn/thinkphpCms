<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >

    <title>首页</title>


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
    
    <link href="http://cdn.bootcss.com/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
    <link href="/thinkphp/Public/css/vender/bootstrap-touch-slider.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/index.css">

    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/vender/smooth-scrollbar.css">




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

    
    <!--start Picture Carousel  PS:图片轮播-->
    <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel"
         data-pause="hover" data-interval="5000">

        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#bootstrap-touch-slider" data-slide-to="0" class="active"></li>
            <li data-target="#bootstrap-touch-slider" data-slide-to="1"></li>
            <li data-target="#bootstrap-touch-slider" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper For Slides -->
        <div class="carousel-inner" role="listbox">

            <!-- start Slide -->
            <?php if(is_array($carousel)): foreach($carousel as $key=>$ca): ?><div class="item">
                    <!-- Slide Background -->
                    <img src="/thinkphp/Uploads/<?php echo ($ca["url"]); ?>" alt="<?php echo ($ca["description"]); ?>" class="slide-image"/>
                    <div class="bs-slider-overlay"></div>

                    <div class="container">
                        <div class="row">
                            <!-- Slide Text Layer -->
                            <div class="slide-text">
                                <h1 data-animation="animated zoomInRight"><?php echo ($ca["name"]); ?></h1>
                                <p data-animation="animated fadeInLeft"><?php echo ($ca["description"]); ?></p>
                                <a href="<?php echo ($ca["link"]); ?>" target="_blank" class="btn btn-default"
                                   data-animation="animated fadeInLeft">查看</a>
                                <a href="<?php echo ($ca["link"]); ?>" target="_blank" class="btn btn-primary"
                                   data-animation="animated fadeInRight">查看</a>
                            </div>
                        </div>
                    </div>
                </div><?php endforeach; endif; ?>
            <!-- End of Slide -->


        </div><!-- End of Wrapper For Slides -->

        <!-- Left Control -->
        <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
            <span class="fa fa-angle-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <!-- Right Control -->
        <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
            <span class="fa fa-angle-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> <!-- End  bootstrap-touch-slider Slider -->

    <!--end Picture Carousel-->
    <div class="container split-line">
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    </div>

    <!--start hot news-->
    <div class="container" id="hot-news">
        <div class="row">
            <?php if(is_array($HotComment)): $hotId = 0; $__LIST__ = array_slice($HotComment,0,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotC): $mod = ($hotId % 2 );++$hotId;?><div data-scroll-reveal class="col-md-3 hot-news-list">
                    <section class="list-news">
                        <div class="content-title">
                            <h1><em>HOT--<?php echo ($hotId); ?></em></h1>
                        </div>

                        <div class="content-description">
                            <span><?php echo ($hotC["title"]); ?></span>
                            <hr/>
                            <p><?php echo (mb_substr($hotC["content"],0,60,'utf-8')); ?></p>
                            <span class="click-for-detail"><a href="<?php echo ($hotC["href"]); ?>" target="_blank">点击查看详情</a></span>
                        </div>
                    </section>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="row">
            <?php if(is_array($HotComment)): $hotId = 0; $__LIST__ = array_slice($HotComment,4,4,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hotC): $mod = ($hotId % 2 );++$hotId;?><div data-scroll-reveal class="col-md-3 hot-news-list">
                    <section class="list-news">
                        <div class="content-title">
                            <h1><em>HOT--<?php echo ($hotId+4); ?></em></h1>
                        </div>

                        <div class="content-description">
                            <span><?php echo ($hotC["title"]); ?></span>
                            <hr/>
                            <p><?php echo (mb_substr($hotC["content"],0,60,'utf-8')); ?></p>
                            <span class="click-for-detail"><a href="<?php echo ($hotC["href"]); ?>" target="_blank">点击查看详情</a></span>
                        </div>
                    </section>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!-- end hot news -->
    <div class="clearfix"></div>

    <!--start category news-->
    <div class="container" id="category-news">
        <hr/>
        <!--start row first category and asking -->
        <div class="row">
            <div class="col-md-8 category-content" id="category-content">
                <div class="row category-content-bg ">
                    <div data-scroll-reveal class="category-title">
                        <h2>最新消息</h2>
                        <span><a href="<?php echo U('Cate/index');?>" target="_blank">查看更多>></a></span>
                    </div>

                    <?php if(is_array($article)): foreach($article as $key=>$ar): ?><div data-scroll-reveal class="row category-items">
                            <div class="col-md-4 category-thumb">
                                <a class="news-img-hover" title="<?php echo ($ar["title"]); ?>"
                                   href="<?php echo U('Details/detail',array('id'=>$ar['id']));?>"
                                   target="_blank">
                                    <img src="<?php echo ($ar['image']); ?>"/>
                                    <span class="mod-hot"><?php echo ($ar['Attr'][0]['name']); ?></span>
                                </a>
                            </div>
                            <div class="col-md-8 category-detail">
                                <h4>
                                    <a href="<?php echo U('Details/detail',array('id'=>$ar['id']));?>" target="_blank"
                                       title="<?php echo ($ar["title"]); ?>"><?php echo ($ar["title"]); ?></a>
                                </h4>
                                <hr/>
                                <div class="news-tags">
                                    <?php if(is_array($ar['tags'])): foreach($ar['tags'] as $key=>$ta): ?><a href="<?php echo U('Index/tags',array('tags'=>urlencode($ta)));?>" target="_blank"
                                           title="<?php echo ($ta); ?>"><?php echo ($ta); ?></a><?php endforeach; endif; ?>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="news-description">
                                    <p><span><?php echo ($ar["hot"]); ?></span><?php echo ($ar["content"]); ?><a
                                            href="<?php echo U('Details/detail',array('id'=>$ar['id']));?>">查看全文>></a></p>

                                </div>
                                <div class="time-and-comment">

                                    <span>
                                        <i class="icon-thumbs-up"></i>赞(<?php echo ($ar["favorite"]); ?>+)
                                    </span>
                                    <span>
                                        <i class="icon-comments-alt"></i>阅 (<?php echo ($ar["click"]); ?>+)
                                    </span>

                                </div>

                            </div>
                            <span class="news-time"><?php echo ($ar["createtime"]); ?></span>
                        </div><?php endforeach; endif; ?>
                    <div data-scroll-reveal class="row get-more-items">
                        <a id="get-more-article">加载更多</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 category-content" id="asking-content">
                <div class="category-content-bg">
                    <div data-scroll-reveal class="category-title ask-title">
                        <h2>24快报</h2>
                        <span><a href="list.html" target="_blank">全部>></a></span>
                    </div>
                    <section data-scrollbar id="fast-scroll">
                        <?php if(is_array($fast)): foreach($fast as $key=>$fa): ?><div class="asking-items">
                                <div class="short-title">
                                    <p class="title-toggle"><i class="icon icon-angle-down icon-fade"></i><?php echo ($fa["title"]); ?>
                                    </p>
                                </div>
                                <div class="asking-detail">
                                    <p class="fade-detail">
                                        <?php echo ($fa["content"]); ?>
                                    </p>
                                    <span class="time-show"><?php echo (diffTime($fa['time'])); ?></span>
                                    <span class="zan-num" data-id="<?php echo ($fa["id"]); ?>"><i class="fa fa-thumbs-up"></i><span
                                            class="favorite-num"><?php echo ($fa["favorite"]); ?></span></span>
                                </div>
                                <div class="date-toggle" style="display: none">
                                    <span class="time-show"><?php echo (diffTime($fa['time'])); ?></span>
                                    <span class="zan-num"><i class="icon icon-thumbs-up"></i><span class="favorite-num"><?php echo ($fa["favorite"]); ?></span></span>
                                </div>

                            </div><?php endforeach; endif; ?>
                    </section>


                </div>
                <div class="category-content-bg" id="list-hot-news">
                    <div class="title-for-hot">
                        <h3>热文</h3>
                        <span class="span-mark"></span>
                    </div>
                    <div class="list-for-hot">
                        <ul>
                            <?php if(is_array($hotArticle)): foreach($hotArticle as $key=>$ho): ?><li data-scroll-reveal>
                                    <div class="list-article-img">
                                        <a href="<?php echo U('Details/detail',array('id'=>$ho['id']));?>" title=""
                                           target="_blank">
                                            <img src="<?php echo ($ho["image"]); ?>">
                                        </a>
                                    </div>
                                    <a class="list-title" href="<?php echo U('Details/detail',array('id'=>$ho['id']));?>"
                                       target="_blank" title="<?php echo ($ho["title"]); ?>">
                                        <?php echo ($ho["title"]); ?>
                                    </a>
                                </li><?php endforeach; endif; ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!--end row first category and asking -->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <!--end category news-->



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

    <script src="http://cdn.bootcss.com/jquery.touchswipe/1.6.18/jquery.touchSwipe.min.js"></script>
    <script src="/thinkphp/Public/js/vender/bootstrap-touch-slider.js"></script>
    <script src="/thinkphp/Public/js/vender/smooth-scrollbar.js"></script>

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


    <script src="/thinkphp/Public/js/index.js"></script>
    <script>
        $(window).resize(function () {
            if($(window).width() <768){
                Scrollbar.destroyAll();
                $('#fast-scroll').css('max-height','100%');
            }else{
                $('#fast-scroll').css('max-height','700px');
                Scrollbar.initAll({
                    speed: 1,
                    overscrollEffect: 'bounce',
                    overscrollEffectColor: '#d2527f'
                });
            }
        });
        $(function () {
            //24快报滚动条
            if($(window).width() <768){
                Scrollbar.destroyAll();
                $('#fast-scroll').css('max-height','100%');
            }else{
                Scrollbar.initAll({
                    speed: 1,
                    overscrollEffect: 'bounce',
                    overscrollEffectColor: '#d2527f'
                });
            }

            $('.zan-num').on('click', function () {
                var _this = $(this);
                var id = $(this).attr('data-id');
                if (undefined === id || id == '' || id == null) return false;
                $.ajax({
                    type: 'post',
                    data: {id: id},
                    url: '<?php echo U("Index/addLike");?>',
                    dataType: 'json',
                    cache: false,
                    success: function (res) {
                        if (res.state == 1) {
                            _this.parent().parent('.asking-items').find('.zan-num .favorite-num').text(res.fastNum);
                        }
                    },
                    error: function () {

                    }
                });
            });

        });

    </script>
    <script type="text/javascript">
        $('#bootstrap-touch-slider').bsTouchSlider();
        $('.carousel-inner .item:eq(0)').addClass('active');
        var arr = ['slide_style_left', 'slide_style_center', 'slide_style_right'];
        $('.slide-text').each(function () {
            var slideClass = arr[Math.floor(Math.random() * arr.length)];
            $(this).addClass(slideClass);
        });
        var pageNum = 2;
        $(document).on('click', '#get-more-article', function () {
            var _this = $(this);
            if (pageNum > <?php echo ($totalPage); ?>) {
                _this.text('已经加载完全部数据');
                return false;
            }
            $.ajax({
                type: 'post',
                url: '<?php echo U("Index/getMore");?>',
                data: {pageNum: pageNum},
                dataType: 'json',
                beforeSend: function () {
                    _this.text('正在加载数据....');
                },
                success: function (res) {
                    if (res.state == 1) {
                        pageNum += 1;
                        var html = '';
                        $.each(res.moreArticle, function (index, value) {
                            var url = '<?php echo U("Details/detail");?>' + '?id=' + value.id;

                            html += '<div data-scroll-reveal class="row category-items">';
                            html += '<div class="col-md-4 category-thumb">';
                            html += '<a class="news-img-hover" title="' + value.title + '" href="' + url + '" target="_blank">';
                            html += '<img src="' + value.image + '"/>';
                            var hotName = '';
                            if (value.Attr.length > 0) {
                                hotName = value.Attr[0].name;
                            }
                            html += '<span class="mod-hot">' + hotName + '</span>';
                            html += '</a>';
                            html += '</div>';
                            html += '<div class="col-md-8 category-detail">';
                            html += '<h4>';
                            html += '<a href="' + url + '" target="_blank" title="value.title">' + value.title + '</a>';
                            html += '</h4>';
                            html += '<hr/>';
                            html += '<div class="news-tags">';
                            $.each(value.tags, function (key, item) {
                                var tagsUrl = '<?php echo U("Index/tags");?>' + '?tags=' + item;
                                html += '<a href="' + tagsUrl + '" target="_blank" title="item">' + item + '</a>'
                            });

                            html += '<div class="clearfix"></div>';
                            html += '</div>';
                            html += '<div class="news-description">';
                            var hot = '';
                            if (!(value.hot === undefined)) {
                                hot = value.hot;
                            }
                            html += '<p><span>' + hot + '</span>' + value.content + '<a href="' + url + '">查看全文>></a></p>';
                            html += '</div>';
                            html += '<div class="time-and-comment">';
                            html += '<a href="list.html" target="_blank">';
                            html += '<i class="icon-thumbs-up"></i>赞(65+)';
                            html += '</a>';
                            html += '<span><i class="icon-comments-alt"></i>阅 (' + value.click + '\+)</span>';
                            html += '</div>';
                            html += '</div>';
                            html += '<span class="news-time">' + value.createtime + '</span>';
                            html += '</div>';
                        });
                        $('.get-more-items').before(html);
                        setImgWidth();
                        checkNull();

                    } else if (res.state == 2) {
                        pageNum = pageNum;
                        _this.text('数据加载失败，请重新加载。');
                    } else {
                        pageNum = pageNum;
                        _this.text('已经加载完全部数据');
                    }
                },
                error: function () {
                    pageNum = pageNum;
                    _this.text('数据加载失败，请重新加载。');
                },
                complete: function () {
                    if (!(_this.text() == '已经加载完全部数据')) {
                        setTimeout(function () {
                            _this.text('加载更多');
                        }, 1500);
                    }
                }
            });
            return false;
        });

    </script>

<script src="/thinkphp/Public/js/login.modal.js"></script>
<!--登录注册表单提交-->
<script src="/thinkphp/Public/js/form.submit.js"></script>

</body>
</html>