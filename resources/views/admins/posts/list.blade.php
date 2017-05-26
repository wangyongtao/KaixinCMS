{{--  --}}

@extends('admins.layouts.home')
 

@section('sidebar')
    @parent

    <ul class="list-group">
    @foreach ($categoryList as $rows)
        <a href="/article/category-{{ $rows['category_name_en'] }}">
            <li class="list-group-item">
                <strong> {{ $rows['category_name'] }} </strong>
                <span class="badge">{{ isset($categoryCount[$rows['category_name_en']]) ? $categoryCount[$rows['name_en']] : '' }}</span>
            </li>
        </a>
    @endforeach
</ul>

@endsection

@section('content')


<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/article/all" class="active">文章列表</a></li>
</ol>

    <div class="">
        @if ($listData['data'])

            <table class="table table-striped">
		        <tr>
		          <th>编号</th>
		          <th>标题</th>
		          <th>最后更新</th>
		          <th>操作</th>
		        </tr>
            @foreach ($listData['data'] as $rows)

		        <tr>
		          <th scope="row">{{ $rows['id'] }}</th>
		          <td><a href="/posts/detail-{{ $rows['id'] }}.html"> {{ $rows['title'] }} </a> </td>
		          <td>{{ $rows['updated_at'] ?: '--' }}</td>
		          <td>
		          <a href="/admins/posts/edit/{{ $rows['id'] }}">Edit</a>
		          </td>
		        </tr>
 
            @endforeach
			</table>

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