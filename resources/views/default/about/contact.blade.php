{{-- This comment will not be present in the rendered HTML --}}

@extends('default.layouts.app')

@section('title', "联系我们" .'-'. config('options.sitename'))

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')


<!-- 路径导航 -->
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/about">关于我们</a></li>
  <li><a href="/feedback" class="active">联系我们</a></li>
</ol>

    <h2>联系我们</h2>


@endsection