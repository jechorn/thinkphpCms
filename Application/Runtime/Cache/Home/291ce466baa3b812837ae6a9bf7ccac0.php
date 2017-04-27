<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" >

    
    <title>详情页</title>



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
    
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/detail.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp/Public/css/sidebar.css">
    <?php if(empty($_SESSION['username'])): ?><style>
            .comment .comment-content-login {
                display: none;
            }

            .comment .comment-content-not-login {
                display: block;
            }
        </style><?php endif; ?>
    <?php if(!empty($_SESSION['username'])): ?><style>
            .comment .comment-content-login {
                display: block;
            }

            .comment .comment-content-not-login {
                display: none;
            }
        </style><?php endif; ?>



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
    <div class="container" id="detail-content">
        <div class="row">
            <div class="col-md-8 article-content">
                <div class="list-margin">
                    <article class="content">
                        <header class="content-title">
                            <h1 class="mscc-title">
                                <a href="" target="_blank"><?php echo ($detail["title"]); ?></a>
                            </h1>
                            <div class="mscc-address ">
                                <span><?php echo (date('Y-m-d H:i',$detail["createtime"])); ?></span>
                                <span>阅<?php echo ($detail["click"]); ?></span>
                            </div>
                        </header>
                        <div class="content-text">
                            <?php echo ($detail["content"]); ?>
                        </div>
                        <!--content_text-->
                        <div class="post-like">
                            <span data-action="ding" data-id="<?php echo ($detail["id"]); ?>" class="favorite"><i
                                    class="fa fa-thumbs-o-up"></i><span class="count"><?php echo ($detail["favorite"]); ?></span>
                            </span>
                        </div>
                        <div class="zhuan">
                            <p>本文转载自其它网站</p>
                            <p>如有再次转载，请加上转载地址。谢谢！</p>

                        </div>

                    </article>
                    <div id="comment"></div>

                    <!--文章评论发表框 start-->
                    <div class="comment">
                        <div class="comment-title">
                            <span>发表评论</span>
                        </div>
                        <div class="comment-content-not-login user-login">
                            <span><a href="javascript:void(0);">登录</a>后才能评论哦</span>
                        </div>
                        <div class="comment-content-login">
                            <form id="form-comment" action="" method="post">
                                <textarea data-scrollbar name="comment"></textarea>
                                <span class="comment-alert-msg"></span>
                            </form>
                        </div>
                        <div class="btn-comment">
                            <button class="btn btn-submit">发表</button>
                            <div class="is-login-msg"></div>
                        </div>
                    </div>
                    <!--文章评论发表框 end-->

                    <!--文章评论展示框 start-->
                    <div class="comment-title comment-tabs">
                        <a class="toggle-comment toggle-comment-default" href="javascript:void (0);" data-type="1" data-state="1">默认评论</a>
                        <a class="toggle-comment toggle-comment-latest" href="javascript:void (0);" data-type="2" data-state="0">最新评论</a>
                    </div>
                    <div class="comment-show">
                        <?php if(empty($comments)): ?><div class="show-comments empty">没有评论内容</div>
                            <?php else: ?>
                            <?php if(is_array($comments)): foreach($comments as $key=>$com): ?><div class="show-comments">
                                    <div class="comment-member-info">
                                        <img src="<?php echo ((isset($com["image"]) && ($com["image"] !== ""))?($com["image"]):'/thinkphp/Public/images/thumb-head.jpg'); ?>"/>
                                        <span class="member-name"><?php echo ($com["username"]); ?></span>
                                        <span class="comment-time"><?php echo (diffTime($com["time"])); ?></span>
                                    </div>
                                    <span class="comment-content"><?php echo ($com["comment"]); ?></span>
                                    <div class="comment-up" data-id="<?php echo ($com["id"]); ?>">
                                        <span class="thumb" data-type="2"><i class="fa fa-thumbs-o-down"></i><span><?php echo ($com["down"]); ?></span></span>
                                        <span class="thumb" data-type="1"><i class="fa fa-thumbs-o-up"></i><span><?php echo ($com["up"]); ?></span></span>
                                    </div>
                                </div><?php endforeach; endif; endif; ?>

                    </div>


                    <!--文章评论展示框 end-->

                    <div class="row xiangguan">
                        <div class="xianguantitle">
                            <?php if(empty($matchArticle)): ?>猜你喜欢
                                <?php else: ?>
                                相关文章！<?php endif; ?>
                        </div>

                        <?php if(empty($matchArticle)): ?><div class="row" style="margin-left: 0px;margin-right: 0px">
                                <?php if(is_array($hotArticle)): $i = 0; $__LIST__ = array_slice($hotArticle,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ho): $mod = ($i % 2 );++$i;?><div class="col-md-4 list-about">
                                        <a href="<?php echo U('Details/detail',array('id'=>$ho['id']));?>" target="_blank"
                                           title="<?php echo ($ho["title"]); ?>">
                                            <img src="<?php echo ($ho["image"]); ?>"/>
                                        </a>
                                        <a href="<?php echo U('Details/detail',array('id'=>$ho['id']));?>" target="_blank" title=""
                                           class="about-title"><?php echo ($ho["title"]); ?></a>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <div class="row" style="margin-left: 0px;margin-right: 0px">

                                <?php if(is_array($hotArticle)): $i = 0; $__LIST__ = array_slice($hotArticle,3,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ho): $mod = ($i % 2 );++$i;?><div class="col-md-4 list-about">
                                        <a href="<?php echo U('Details/detail',array('id'=>$ho['id']));?>" target="_blank"
                                           title="<?php echo ($ho["title"]); ?>">
                                            <img src="<?php echo ($ho["image"]); ?>"/>
                                        </a>
                                        <a href="<?php echo U('Details/detail',array('id'=>$ho['id']));?>" target="_blank" title=""
                                           class="about-title"><?php echo ($ho["title"]); ?></a>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <?php else: ?>

                            <div class="row" style="margin-left: 0px;margin-right: 0px">
                                <?php if(is_array($matchArticle)): $i = 0; $__LIST__ = array_slice($matchArticle,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ma): $mod = ($i % 2 );++$i;?><div class="col-md-4 list-about">
                                        <a href="<?php echo U('Details/detail',array('id'=>$ma['id']));?>" target="_blank"
                                           title="<?php echo ($ma["title"]); ?>">
                                            <img src="<?php echo ($ma["image"]); ?>"/>
                                        </a>
                                        <a href="<?php echo U('Details/detail',array('id'=>$ma['id']));?>" target="_blank" title=""
                                           class="about-title"><?php echo ($ma["title"]); ?></a>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                            <div class="row" style="margin-left: 0px;margin-right: 0px">

                                <?php if(is_array($matchArticle)): $i = 0; $__LIST__ = array_slice($matchArticle,3,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ma): $mod = ($i % 2 );++$i;?><div class="col-md-4 list-about">
                                        <a href="<?php echo U('Details/detail',array('id'=>$ma['id']));?>" target="_blank"
                                           title="<?php echo ($ma["title"]); ?>">
                                            <img src="<?php echo ($ma["image"]); ?>"/>
                                        </a>
                                        <a href="<?php echo U('Details/detail',array('id'=>$ma['id']));?>" target="_blank" title=""
                                           class="about-title"><?php echo ($ma["title"]); ?></a>
                                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div><?php endif; ?>

                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="right-margin">
                    <div data-scroll-reveal class="search-keyword">
                        <form action="" method="post">
                            <input class="keyword-search form-control" name="keyword" type="text" value=""
                                   placeholder="请输入关键词"/>
                            <input class="submit-btn" type="submit" value=""/>
                        </form>
                    </div>
                    <hr/>
                    <div data-scroll-reveal class="rand-hot-news">
                        <span class="change-item"><i class="fa fa-refresh" aria-hidden="true" style="float:right;"></i>换一批</span>
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


        </div>

        <!-- start left-button-group  -->
        <div class="left-btn-group position-absolute">
            <ul>
                <li class="wx-share">
                    <a><i class="fa fa-weixin"></i></a>
                    <div class="pic-container">
                        <div class="triangle"></div>
                        <div id="qrcode" class="pic qrcode"></div>
                    </div>
                </li>
                <li class=""><a href="#comment"><i class="fa fa-comment-o"></i></a></li>
                <li class="zan-favorite" data-id="<?php echo ($detail["id"]); ?>">
                    <a><i class="fa fa-thumbs-o-up"></i></a>
                    <span class="article-zan">+1</span>
                    <div class="res-msg">
                    </div>
                </li>
            </ul>

        </div>
        <!-- end left-button-group  -->

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

    <script src="/thinkphp/Public/js/vender/smooth-scrollbar.js"></script>
    <script>
        Scrollbar.initAll({
            speed: 1,
            overscrollEffect: 'bounce',
            overscrollEffectColor: '#d2527f'
        });
        $(document).ready(function () {
            $('.content .content-text img').each(function () {
                $(this).css({
                    'max-width': '100%',
                    'width': 'auto',
                    'height': 'auto',
                    'display': 'block',

                });
                $(this).parents('p').css('text-indent', '0px');
            });
            //判断是否是空节点
            $('.content .content-text h2').each(function () {
                if ($(this).html().trim() === '') {
                    $(this).remove();
                }
            });


        });

        //判断已经滚动的高度，动态设置position值
        var judgeScrollTop = function (height, positionLeft, positionTop) {
            if ($(window).scrollTop() > height) {
                $('.left-btn-group').removeClass('position-absolute').addClass('position-fixed');
                $('.left-btn-group').css({
                    'left': positionLeft + 'px',
                    'top': positionTop + 'px'
                });
            } else {
                $('.left-btn-group').removeClass('position-fixed').addClass('position-absolute');
                $('.left-btn-group').css({
                    'left': '-60px',
                    'top': '30px'
                });

            }

        };
        //设置文章左侧固定栏的定位
        var setBtnGroupPosition = function () {
            var windowWidth = $(window).width();
            var containerWidth = $('#detail-content').width();
            var leftGroupWidth = $('.left-btn-group').width();
            var positionLeft = ((windowWidth - containerWidth) / 2) - leftGroupWidth - 15;

            if (positionLeft < 5) {
                $('.left-btn-group').css('display', 'none');
                return false;
            }
            $('.left-btn-group').css('display', 'block');
            var headerHeight;
            var positionTop;

            if ($('.main-navigation').hasClass('navbar-fixed-top')) {
                $('.left-btn-group').removeClass('position-absolute').addClass('position-fixed');
                headerHeight = $('.main-navigation').height();
                positionTop = headerHeight + 30;
                $('.left-btn-group').css({
                    'left': positionLeft + 'px',
                    'top': positionTop + 'px'
                });

            } else {
                $('.left-btn-group').removeClass('position-fixed').addClass('position-absolute');
                $('.left-btn-group').css({
                    'left': '-60px',
                    'top': '30px'
                });
                headerHeight = $('.main-navigation').offset().top;
                positionTop = $('#detail-content').offset().top - headerHeight + 30;
            }


            $(window).scroll(function () {

                judgeScrollTop(headerHeight, positionLeft, positionTop);
            });


        };

        //执行设置position的方法，设置.left-btn-group类的位置
        setBtnGroupPosition();


        //相关文章的图片高度控制
        var setImage = function () {
            var tmpHeight = 0;
            $('.xiangguan .list-about').each(function () {
                var _this = $(this).find('img');
                //w为box的宽度
                var w = $(this).width();
                //h为box的高度
                var h = w * 0.7;
                var img = new Image();
                img.src = _this.attr("src");
                var realWidth = img.width;  //图片的原始宽度
                var realHeight = img.height; //图片的原始高度
                if (realHeight / realWidth >= 0.7) {
                    var multiple = (realWidth / w);

                    var boxHeight = (realHeight / multiple);
                    var position = -((boxHeight - h) / 2);
                    _this.css({
                        'width': '100%',
                        'position': 'relative',
                        'top': position + 'px'
                    });
                    _this.parent().css({
                        'max-height': h + 'px',
                        'overflow': 'hidden'
                    });
                } else {
                    var multiple = (realHeight / h);

                    //boxWidth 为宽度
                    var boxWidth = (realWidth / multiple);
                    var position = -((boxWidth - w) / 2);

                    _this.parent().css({
                        'overflow': 'hidden',
                        'height': h + 'px',
                        'max-width': w + 'px',
                    });
                    _this.css({
                        'position': 'relative',
                        'left': position + 'px',
                        'height': '100%'

                    });


                }

            });
        };
        setImage();
        //相关文章图片显示
        $('.xiangguan .list-about img').css('display', 'block');
        $(window).resize(function () {
            setImage();
            setBtnGroupPosition();
        });

    </script>

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
        $('.change-item').click(function () {
            $.ajax({
                type: 'POST',
                url: '<?php echo U("Details/randArticle");?>',
                dataType: 'json',
                success: function (res) {
                    if (res.state === 1) {
                        $('.rand-items').empty();
                        var html = '';
                        $.each(res.randArticle, function (index, value) {
                            var url = '<?php echo U("Details/detail");?>' + '?id=' + value.id;
                            html += '<li class="rand-news-list">';
                            html += '<a href="' + url + '" target="_blank" title="' + value.title + '"><span>' + (index + 1) + '</span>' + value.title + '</a>';
                            html += '</li>';

                        });
                        $('.rand-items').html(html);

                    }
                }

            });
        })
    </script>
    <script>
        $('.zan-favorite').click(function () {
            var end = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            var _this = $(this);
            var id = _this.attr('data-id');

            $.ajax({
                type: "post",
                url: "<?php echo U('Details/like');?>",
                data: {id: id},
                dataType: 'json',
                //cache:false, //不缓存此页面
                success: function (res) {
                    if (res.state == 1) {
                        //var end = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                        $('.article-zan').addClass('animated fadeInDown').one(end, function () {
                            $(this).removeClass('animated fadeInDown');

                        });
                        $('.zan-favorite .fa-thumbs-o-up').addClass('animated zoomIn').one(end, function () {
                            $(this).removeClass('animated zoomIn');

                        });

                    } else {
                        $('.res-msg').text(res.msg);
                        //var end = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                        $('.res-msg').addClass('animated fadeInDown').one(end, function () {
                            $(this).removeClass('animated fadeInDown');

                        });

                    }

                },
                error: function () {
                    $('.res-msg').text('请求超时');
                    var left = ($('.left-btn-group ul li.zan-favorite').width() - $('.res-msg').width() - 2) / 2;
                    $('.res-msg').css('left', left);
                    //var end = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                    $('.res-msg').addClass('animated fadeInDown').one(end, function () {
                        $(this).removeClass('animated fadeInDown');

                    });
                }

            });

        });
        $('.post-like .favorite').click(function () {
            var _this = $(this);
            var id = _this.attr('data-id');
            var showMsg = function (state, msg) {
                var html = '<div class="pop-up">' +
                    '<div class="pop-up-msg">' + msg + '</div>' +
                    '<div class="triangle"></div>' +
                    '</div>';
                var show = function () {
                    _this.append(html);
                    $('.pop-up').fadeIn(300, function () {
                        setTimeout(function () {
                            $('.pop-up').fadeOut(300, function () {
                                $('.pop-up').remove();
                            });
                        }, 1500);
                    });

                };
                if (state === 1) {
                    $('.favorite .fa-thumbs-o-up').animate({
                        fontSize: '35px',
                        opacity: 0.8,

                    }, 300, function () {
                        $('.favorite .fa-thumbs-o-up').animate({
                            fontSize: '25px',
                            opacity: 1

                        }, 300, function () {
                            show();

                        });
                    });
                } else {
                    show();
                }
            };

            $.ajax({
                type: "post",
                url: "<?php echo U('Details/like');?>",
                data: {id: id},
                dataType: 'json',
                //cache:false, //不缓存此页面
                success: function (res) {
                    if (res.state === 1) {
                        $('.favorite .count').text(res.favorite);
                        showMsg(res.state, res.msg);
                    } else {
                        showMsg(res.state, res.msg);
                    }

                },
                error: function () {
                    showMsg(2, '请稍后再试');
                }

            });
        })
    </script>
    <script>
        $(function () {
            var end = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

            //评论内容数据验证
            //ajax验证用户是否登录
            $('.btn-submit').click(function () {
                var comments = $('#form-comment textarea').val().trim();
                if (comments === '' || comments === null) {
                    $('.comment-alert-msg').text('不能为空');
                    $('.comment-alert-msg').addClass('animated zoomIn').one(end, function () {
                        $(this).removeClass('animated zoomIn');
                    });
                    return false;

                }
                if (comments.length < 10 || comments.length > 250) {
                    $('.comment-alert-msg').text('字数在10-250之间');
                    $('.comment-alert-msg').addClass('animated zoomIn').one(end, function () {
                        $(this).removeClass('animated zoomIn');
                    });
                    return false;
                }
                var aid = $('.post-like .favorite').attr('data-id');
                var data = {
                    comment: comments,
                    aid: aid
                };
                $.ajax({
                    type: 'post',
                    url: '<?php echo U("Comment/addComment");?>',
                    dataType: 'json',
                    data: data,
                    beforeSend: function () {
                        $('.btn-submit').text('数据提交中.....');
                        //$('.btn-submit').attr('disabled', 'disabled');
                    },
                    success: function (res) {

                        //state 1为用户已经登录并且数据验证成功，2为用户没有登录，3用户已经登录，但数据没有验证成功
                        if(res.state === 2) {
                            $('.comment-content-not-login').css('display', 'block');
                            $('.comment-content-login').css('display', 'none');
                            $('.is-login-msg').text(res.msg);
                            $('.is-login-msg').addClass('animated fadeInDown').one(end, function () {
                                $(this).removeClass('animated fadeInDown');
                            });
                        }else {
                            $('.comment-content-not-login').css('display', 'none');
                            $('.comment-content-login').css('display', 'block');
                            $('.is-login-msg').text(res.msg);
                            $('.is-login-msg').addClass('animated fadeInDown').one(end, function () {
                                $(this).removeClass('animated fadeInDown');
                            });
                        }
                        if(res.state === 1){
                            $('#form-comment textarea').val('');
                        }


                    },
                    error: function () {
                        $('.is-login-msg').text('请求超时');
                        $('.is-login-msg').addClass('animated fadeInDown').one(end, function () {
                            $(this).removeClass('animated fadeInDown');
                        });
                    },
                    complete: function () {
                        $('.btn-submit').text('发表');
                       //$('.btn-submit').attr('disabled', 'false');
                    }
                });
                return false;
            });

        });


    </script>
    <script>
        //默认评论与最新评论切换
        $(function () {
            $('.toggle-comment').click(function () {
                var _this = $(this);
                var state = parseInt($(this).attr('data-state'));
                if(state === 1 ) return false;
                var type = $(this).attr('data-type');
                var aid = $('.zan-favorite').attr('data-id');
                var data = {type:type,aid:aid};
                $.ajax({
                    type:'post',
                    data :data,
                    url:'<?php echo U("Comment/handle");?>',
                    dataType:'json',

                    success: function (res) {
                        if(res.state === 1){
                            if(res.msg.length === 0){
                                var inner  ='<div class="row show-comments empty">没有评论内容</div>';
                                $('.comment-show').empty();
                                $('.comment-show').html(inner);
                                return false;

                            }
                            var html ='';
                            $.each(res.msg, function (index, value) {
                                html += '<div class="row show-comments">';
                                html += '<div class="comment-member-info">';
                                if (null === value.image || '' === value.image) {
                                    value.image = '/thinkphp/Public/images/thumb-head.jpg'
                                }

                                html += '<img src="' + value.image + '"/>';
                                html += '<span class="member-name">' + value.username + '</span>';
                                html += '<span class="comment-time">'+value.time+'</span>';
                                html += '</div>';
                                html += '<span class="comment-content">' + value.comment + '</span>';
                                html += '<div class="comment-up" data-id="'+value.id+'">';
                                html += '<span class="thumb"><i class="fa fa-thumbs-o-down"></i><span>' + value.down + '</span></span>';
                                html += '<span class="thumb"><i class="fa fa-thumbs-o-up"></i><span>' + value.up + '</span></span>';
                                html += ' </div></div>';

                            });
                            $('.comment-show').html(html);
                            _this.attr('data-state','1');
                            _this.css('color','#1d1d1d')
                            _this.siblings().attr('data-state','0');
                            _this.siblings().css('color','#bbb');

                        }

                    },
                    error: function () {

                    },



                })
            });
        });
    </script>
    <script>
        $(function () {
           $('.comment-up span.thumb').click(function () {
               var _this = $(this);
               var type = $(this).attr('data-type');
               var aid = $('.zan-favorite').attr('data-id');
               var id = _this.parent().attr('data-id');
               var data = {type:type,aid:aid,id:id};
               $.ajax({
                   url: '<?php echo U("Comment/ifLike");?>',
                   type: 'post',
                   dataType:'json',
                   data:data,
                   success:function (res) {
                       if(res.state ===1){
                           _this.find('.fa').css('color','red');
                           _this.find('span').text(res.data);
                       }else{
                           var html = '<span class="toast-msg">'+res.msg+'</span>'
                           _this.append(html);
                           $('.toast-msg').fadeIn(500,function () {
                               $('.toast-msg').fadeOut(500,function () {
                                   $('.toast-msg').remove();
                               });

                           });

                       }
                   },
                   error:function () {

                   }
               });
           });
        });
    </script>

<script src="/thinkphp/Public/js/login.modal.js"></script>
<!--登录注册表单提交-->
<script src="/thinkphp/Public/js/form.submit.js"></script>

</body>
</html>