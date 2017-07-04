@extends('default.layouts.posts')
 
@section('content')

	<ol class="breadcrumb">
	  <li><a href="/">首页</a></li>
	  <li><a href="/jiaocheng" class="active">教程列表</a></li>
	</ol>

	@if ($detailData)
    <div class="panel panel-default">
	      <div class="panel-heading">
	        	<a href="/jiaocheng/show-{{ $detailData['id'] }}.html"> {{ $detailData['book_name'] }} </a>
	      </div>
	      <div class="panel-body">
	          	
	          	{!! $detailData['book_description'] !!}

	      </div>
    </div>
    @endif


@endsection