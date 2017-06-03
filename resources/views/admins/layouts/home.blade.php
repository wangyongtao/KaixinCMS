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
                <a class="navbar-brand" href="{{ url('/') }}">
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

<!--             <div class="list-group">
			  <a href="#" class="list-group-item active">
			    管理后台
			  </a>
			  <a href="/admins/posts" class="list-group-item"> > 文章 (Posts)</a>

			  <a href="/admins/categories" class="list-group-item"> > 分类 (Categories)</a>

			  <a href="/admins/links" class="list-group-item"> > 链接 (Links)</a>

			  <a href="/admins/users" class="list-group-item"> > 用户 (Users)</a>

			</div> -->
            @show
            </div>
            <div class="col-md-10"> @yield('content') </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- Scripts -->

</body>
</html>
