@extends('admins.layouts.home')

@section('content')

<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/" class="active">用户列表</a></li>
</ol>

<div class="main">
    <div class="panel panel-default">
        <div class="panel-heading">
        链接列表
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
                          <td><a href="/posts/detail-{{ $rows['id'] }}.html"> {{ $rows['name'] }} </a> </td>
                          <td>{{ $rows['updated_at'] ?: '--' }}</td>
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