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

  <div class="panel panel-default">
      <div class="panel-heading">
          <strong> 分类管理 </strong>
          <a href="/admins/categories/add" class="btn btn-xs btn-success">新增分类</a>
      </div>
      <div class="panel-body">
       
        
            <table class="table table-striped">
              <tr>
                <th>ID</th>
                <th>平台</th>
                <th>分类名称</th>
                <th>最后更新</th>
                <th>操作</th>
              </tr>
              @foreach ($categoryList as $rows)

              <tr>
                <th scope="row">{{ $rows['category_id'] }}</th>
                <th scope="row">{{ $rows['platform'] }}</th>
                <td> 
                  <a href="/admins/posts?category={{ $rows['category_name_en'] }}"> {{ $rows['category_name'] }} </a>
                  
                  ( <span>{{ $rows['category_name_en'] }} </span> )

                </td>
                <td>{{ $rows['updated_at'] ?: '--' }}</td>
                <td>
                <a href="/admins/categories/edit/{{ $rows['category_id'] }}">Edit</a>
                </td>
              </tr>

              @endforeach
          </table>

      </div>
  </div>





@endsection