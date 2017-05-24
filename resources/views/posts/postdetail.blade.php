{{--  --}}

@extends('layouts.app')

{{-- META标题、关键词、描述等 --}}
@section('title')
文章列表@endsection

@section('keywords')
Wang123.net @endsection

@section('sidebar')
    @parent

 
@endsection

@section('content')

	<ol class="breadcrumb">
	  <li><a href="/">首页</a></li>
	  <li><a href="/article/all" class="active">文章列表</a></li>
	</ol>

	@if ($detailData)
    <div class="panel panel-default">
	      <div class="panel-heading">
	        	<a href="/posts/detail-{{ $detailData['id'] }}.html"> {{ $detailData['title'] }} </a>
	      </div>
	      <div class="panel-body">
	          	
	          	{{ $detailData['content'] }}

	      </div>
    </div>
    @endif


@endsection