@extends('admins.layouts.home')

@section('sidebar')
    @parent

    <ul class="list-group">
    @foreach ($categoryMenu as $key=>$categoryRows)
        <li class="list-group-item active"><strong> {{ $key }} </strong></li>
        @foreach ($categoryRows as $rows)
            <li class="list-group-item">
                <a href="/admins/posts?category={{ $rows['category_name_en'] }}">
                    <strong> {{ $rows['category_name'] }} </strong>
                    <span class="badge">{{ isset($categoryCount[$rows['category_name_en']]) ? $categoryCount[$rows['name_en']] : '' }}</span></a>
            </li>
            
        @endforeach
    @endforeach
    </ul>

@endsection

@section('content')

    <ol class="breadcrumb">
      <li><a href="/">首页</a></li>
      <li><a href="/" class="active">分类列表</a></li>
    </ol>



@endsection