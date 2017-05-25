{{--  --}}

@extends('posts.layout')

{{-- META标题、关键词、描述等 --}}
@section('title')
文章列表@endsection

@section('keywords')
Wang123.net @endsection

@section('sidebar')
    @parent

    <ul class="list-group">
    @foreach ($category as $rows)
        <a href="/article/category-{{ $rows['name_en'] }}">
            <li class="list-group-item">
                <strong> {{ $rows['name'] }} </strong>
                <span class="badge">{{ isset($categoryCount[$rows['name_en']]) ? $categoryCount[$rows['name_en']] : '' }}</span>
            </li>
        </a>
    @endforeach
</ul>

@endsection

@section('mainContent')


<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/article/all" class="active">文章列表</a></li>
</ol>

    <div class="">
        @if ($listData['data'])
            @foreach ($listData['data'] as $rows)
                <div title="{{ $rows['title'] }}">
                        <div class="article-title">
                        <a href="/a/detail-{{ $rows['id'] }}.html"> {{ $rows['title'] }} </a>
                        </div>
                        <hr>
                </div>
            @endforeach
        @endif
    </div>
 
    <!-- 显示分页 -->
    <nav aria-label="...">
        <ul class="pager">
            @if ($listData['prev_page_url'])
                <li class="previous"><a href="{{$listData['prev_page_url']}}">上一页 <span aria-hidden="true">&larr;</span></a></li>
            @else
                <li class="previous disabled"><a href="#">上一页 <span aria-hidden="true">&larr;</span></a></li>
            @endif

            @if ($listData['next_page_url'])
                <li class="next"><a href="{{$listData['next_page_url']}}">下一页 <span aria-hidden="true">&rarr;</span></a></li>
            @else
                <li class="next disabled"><a href="#">下一页 <span aria-hidden="true">&rarr;</span></a></li>
            @endif


        </ul>
    </nav>

@endsection