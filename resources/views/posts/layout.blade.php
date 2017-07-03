<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签必须放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>@yield('title') {{config('options.sitename')}}</title>
    <meta name="author" content="http://wang123.net">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <!-- Bootstrap -->
    <!-- <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/default.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style type="text/css">
        body {
            font-size: 14px;
        }
        .sponsor img{
            opacity: 0.7;
            border-radius:25px;
        }
        .sponsor img:hover{
            opacity: 1.0;
        }
    </style>
    <script type="text/javascript">
        var _hmt = _hmt || [];
        var _baseUrl = 'http://wang123.net';
    </script>
</head>
<body class="page-body">

<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" title="{{config('options.sitename')}}">{{config('options.sitename')}}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/article/all">热门文章</a></li>
                <!-- <li><a href="/learn-english" title="英语学习">英语学习</a></li> -->
                <li><a href="/website" title="网址大全">网址大全</a></li>

<!--                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">开发与技术 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">PHP</a></li>
                        <li><a href="#">前端开发</a></li>
                        <li><a href="#">后端开发</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
 -->                <li><a href="/about">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/login?source=header">Login</a></li>
                <li><a href="/register?source=header">Register</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<!-- main 
========================================-->
<div class="container">
    <script charset="gbk" src="http://www.baidu.com/js/opensug.js"></script>
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="well">
                <p>...</p>
            </div>

            @yield('mainContent')
        </div>

        <div class="col-sm-12 col-md-4">

            <form class="form-inline" action="http://www.baidu.com/baidu" target="_blank">
                <input name="tn" type="hidden" value="baidu">
                <input class="form-control" id="kw" type="text" name="wd" baiduSug="1" placeholder="输入搜索关键词">
                <input type="submit" class="btn btn-info" value="百度搜索">
            </form>
 
            @section('sidebar')
                <!-- This is the master sidebar. -->
            @show

            <br/>
            <div class="panel panel-default">
              <div class="panel-heading">
                广告赞助
              </div>
              <div class="panel-body">
                  <a href="https://www.aliyun.com/">阿里云</a>
                  <a href="https://www.upyun.com/?ref=wang123net">又拍云</a>
              </div>
            </div>
            
        </div>
    </div>

</div>

<!-- footer
========================================-->
<footer class="page-footer">

         <div class="container">
             <div class="row">
                <div class="col-md-4">
                     <h4 class="title">关于</h4>
                     <ul class="page-footer-links">
                         <li><a href="#about">关于我们</a></li>
                         <li><a href="#contact">联系我们</a></li>
                         <li><a href="/feedback">意见反馈</a></li>

                     </ul>
                </div>
                <div class="col-md-4">
                     <h4 class="title">支持</h4>
                     <ul class="page-footer-links">
                         <li><a href="#help">帮助中心</a></li>
                         <li><a href="#help">常见问题</a></li>
                         <li><a href="#help">服务条款</a></li>
                     </ul>
                </div>
                <div class="col-md-4">
                     <h4 class="title">友情链接</h4>
                     <ul class="page-footer-links">
                         <li><a href="https://segmentfault.com/">SegmentFault</a></li>
                         <li><a href="http://www.oschina.net/">oschina</a></li>
                         <li><a href="http://www.ifeng.com/">ifeng</a></li>
                         <li><a href="https://www.2345.com/?k1959251">2345</a></li>
                         <li><a href="https://www.yahoo.com/">yahoo</a></li>
                         <li><a href="https://github.com">github</a></li>
                         <li><a href="/">更多链接</a></li>
                     </ul>
                </div>
             </div>
         </div>


         <div class="container">

            <p>Designed and built with all the love in the world by <a href="https://twitter.com/mdo" target="_blank">@mdo</a> and <a href="https://twitter.com/fat" target="_blank">@fat</a>. Maintained by the <a href="https://github.com/orgs/twbs/people">core team</a> with the help of <a href="https://github.com/twbs/bootstrap/graphs/contributors">our contributors</a>.</p>

            <p>
                存储赞助商: 
                <a target="_blank" href="https://www.upyun.com/?ref=xiaohua111.com" class="sponsor"><img alt="又拍云" title="又拍云-国内领先的CDN服务提供商" src="/images/youpaiyun_logo.png" height="25"></a>
                <a target="_blank" href="https://www.qiniu.com/?ref=xiaohua111.com" class="sponsor"><img alt="七牛云" title="七牛云-国内领先的企业级云服务商" src="/images/qiniu_logo.jpg" height="25"></a>
            </p>

            <p> 
              © 2012-<?php echo date('Y');?>  
              <a href="<?php echo config('app.url')?>" title="<?php echo config('app.name')?>"><?php echo config('app.name')?></a> &nbsp;
              <a href="http://www.miitbeian.gov.cn" target="_blank" title="京ICP备12034103号">京ICP备12034103号</a> &nbsp;
              <a href="/sitemap.xml" title="网站地图">sitemap.xml</a> 
            </p>

        </div>

</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.js"></script>

<!-- baidu tongji
================================================== -->
<script>
var _hmt = _hmt || [];
(function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?0b25951159ac324262b493174bdbc199";
    var s = document.getElementsByTagName("script")[0]; 
    s.parentNode.insertBefore(hm, s);
})();
</script>

</body>
</html>