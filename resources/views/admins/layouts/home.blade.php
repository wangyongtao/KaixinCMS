<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>管理后台 - {{ config('app.name', 'Admin') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <style type="text/css">
        .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
            position: relative;
            min-height: 1px;
            padding-left: 5px; 
            padding-right: 5px; 
        }
    </style>
</head>
<body id="app">

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>



                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/admins/dashboard') }}">
                    管理后台
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                    @if ( Request::is('admins/posts*') )
                        <li class="active"><a href="{{ route('admin-posts') }}">文章</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-posts') }}">文章</a></li>
                    @endif
                    @if ( Request::is('admins/categories*') )
                        <li class="active"><a href="{{ route('admin-category') }}">分类</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-category') }}">分类</a></li>
                    @endif                        
                    @if ( Request::is('admins/links*') )
                        <li class="active"><a href="{{ route('admin-links') }}">链接</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-links') }}">链接</a></li>
                    @endif
                    @if ( Request::is('admins/users*') )
                        <li class="active"><a href="{{ route('admin-users') }}">用户</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-users') }}">用户</a></li>
                    @endif
                    @if ( Request::is('admins/books*') )
                        <li class="active"><a href="{{ route('admin-books') }}">教程</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-books') }}">教程</a></li>
                    @endif
<!-- 
                    @if ( Request::is('admins/goods*') )
                        <li class="active"><a href="{{ route('admin-goods') }}">商品</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-goods') }}">商品</a></li>
                    @endif

                    @if ( Request::is('admins/orders*') )
                        <li class="active"><a href="{{ route('admin-orders') }}">订单</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-orders') }}">订单</a></li>
                    @endif

                    @if ( Request::is('admins/promotion*') )
                        <li class="active"><a href="{{ route('admin-promotion') }}">促销</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-promotion') }}">促销</a></li>
                    @endif

                    @if ( Request::is('admins/advisory*') )
                        <li class="active"><a href="{{ route('admin-advisory') }}">咨询</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-advisory') }}">咨询</a></li>
                    @endif -->

                    @if ( Request::is('admins/feedback*') )
                        <li class="active"><a href="{{ route('admin-feedback') }}">反馈</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-feedback') }}">反馈</a></li>
                    @endif

                    @if ( Request::is('admins/settings*') )
                        <li class="active"><a href="{{ route('admin-settings') }}">设置</a></li>
                    @else
                        <li class=""><a href="{{ route('admin-settings') }}">设置</a></li>
                    @endif
                    </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('home') }}">网站首页</a></li>
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-2" style="font-size:12px">
            @section('sidebar')

                @if(! empty($categoryList))
                 <ul class="list-group">
                    <!-- <li class="list-group-item active">分类列表</li> -->
                    @foreach ($categoryList as $rows)
                        <li class="list-group-item">
                            <a href="/admins/posts?category={{ $rows['category_name_en'] }}">
                                <strong> {{ $rows['category_name'] }} </strong>
                                <span class="badge">{{ isset($categoryCount[$rows['category_name_en']]) ? $categoryCount[$rows['name_en']] : '' }}</span></a>
                        </li>
                        
                    @endforeach
                </ul>
                @endif

            @show
            </div>
            <div class="col-md-10"> @yield('content') </div>
        </div>
    </div>

    @include('admins.layouts.footer')

    <!-- Scripts -->

</body>
</html>
