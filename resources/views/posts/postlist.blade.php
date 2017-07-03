{{--  --}}

@extends('layouts.posts')

{{-- META标题、关键词、描述等 --}}
@section('title')
文章列表@endsection

@section('keywords')
Wang123.net @endsection

@section('sidebar')
    @parent

    <ul class="list-group">
    @foreach ($categoryList as $rows)
        <a href="/posts/category-{{ $rows['category_name_en'] }}">
            <li class="list-group-item">
                <strong> {{ $rows['category_name'] }} </strong>
                <span class="badge">{{ isset($categoryCount[$rows['category_name_en']]) ? $categoryCount[$rows['name_en']] : '' }}</span>
            </li>
        </a>
    @endforeach
</ul>

@endsection

@section('content')
 
    <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
        @if ($listData['data'])
            @foreach ($listData['data'] as $rows)
                <div title="{{ $rows['title'] }}">
                        <div class="article-title">
                        <a href="/posts/detail-{{ $rows['id'] }}.html"> {{ $rows['title'] }} </a>
                        </div>
                        <hr>
                </div>
            @endforeach
        @endif
        </div>

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