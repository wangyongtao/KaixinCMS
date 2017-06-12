@extends('admins.layouts.home')
 
@section('content')

<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/article/all" class="active">配置管理</a></li>
</ol>

<div class="main">
 
    <div class="panel panel-default">
      <div class="panel-heading">
         配置管理 <a href="/admins/posts/add" class="btn btn-xs btn-success">  新增文章 </a>
      </div>
      <div class="panel-body">

        
        @if ($listData)

            <table class="table table-striped">
                <tr>
                  <th>编号</th>
                  <th>标题</th>
                  <th>最后更新</th>
                  <th>操作</th>
                </tr>
            @foreach ($listData as $rows)

                <tr>
                  <th scope="row">{{ $rows['id'] }}</th>
                  <td><a href="/posts/detail-{{ $rows['id'] }}.html"> {{ $rows['title'] }} </a> </td>
                  <td>
                    <small> {{ $rows['created_at'] ?: '--' }} </small> <br/>
                    <small> {{ $rows['updated_at'] ?: '--' }} </small> 
                  </td>
                  <td>
                  <a href="/admins/posts/edit/{{ $rows['id'] }}">Edit</a>
                  </td>
                </tr>
 
            @endforeach
            </table>

        @endif
        </div>
    </div>
</div>

@endsection