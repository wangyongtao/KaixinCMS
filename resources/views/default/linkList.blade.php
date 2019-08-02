@extends('default.layouts.postLayout')

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
                    <span class="badge">{{ isset($categoryCount[$rows['category_name_en']]) ? $categoryCount[$rows['category_name_en']] : '' }}</span>
                </li>
            </a>
        @endforeach
    </ul>

@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            友情链接 Links
        </div>
        <div class="panel-body">
            @if (!empty($listData))
                @foreach ($listData as $rows)
                    <div title="{{ $rows['link_name'] }}">
                        <div class="article-title">
                            <a href="/a/{{ $rows['id'] }}.html"> {{ $rows['link_name'] }} </a>
                            <br/>
                            <span>{{ $rows['link_description']  }}</span>
                        </div>
                        <hr>
                    </div>
                @endforeach
            @endif
        </div>

    </div>


@endsection
