@extends('admins.layouts.home')

@section('content')

<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/admins/feedback">用户反馈列表</a></li>
  <li><a href="" class="active">列表</a></li>
</ol>

<div class="main">
    <div class="panel panel-default">
        <div class="panel-heading">
        用户反馈列表 

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
                          <td>

                          <p> {{ $rows['content'] }} </p>

                          <small>
                          	{{ $rows['device'] }}
                          	{{ $rows['browser'] }}
                          	{{ $rows['platform'] }}
                          	{{ $rows['ip_address'] }}
                          </small>
                          </td>
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