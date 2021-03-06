@extends('admins.layouts.home')

@section('content')

<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/admins/links">链接</a></li>
  <li><a href="" class="active">列表</a></li>
</ol>

<div class="main">
    <div class="panel panel-default">
        <div class="panel-heading">
        链接列表
                              <a href="/admins/links/add" class="btn btn-xs btn-success">新增</a>

        </div>
      <div class="panel-body">
        
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
                          <td><a href="/links/detail-{{ $rows['id'] }}.html"> {{ $rows['link_name'] }} </a> </td>
                          <td>{{ $rows['updated_at'] ?: '--' }}</td>
                          <td>
                          <a href="/admins/links/edit/{{ $rows['id'] }}">Edit</a>
                          </td>
                        </tr>
         
                    @endforeach
                    </table>

                @endif

      </div>
    </div>
</div>

@endsection