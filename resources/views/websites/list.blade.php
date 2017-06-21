@extends('default.layouts.posts')


{{-- META标题、关键词、描述等 --}}
@section('title')
网址导航@endsection

@section('description')
网123(Wang123.net), 简洁的上网导航网址导航，提供最简单便捷的上网导航服务。轻松上网,从这里开始!@endsection

@section('keywords')
Wang123.net, 网址导航, 网址大全@endsection

{{-- 侧边栏 sidebar --}}
@section('sidebar')
    @parent

@endsection

@section('content')

        <h2>网址大全</h2>
 
        <table class="table table-bordered">
        <tr>
            <th>网站名</th>
            <th>行业</th>
            <th>地区</th>
            <th>Alexa Rank</th>
            <th>百度 Rank</th>
            <!-- <th>PR</th> -->
        </tr>
        @foreach ($listData['data'] as $rows)
            <tr>
                <td> <a href="http://{{$rows['site_url']}}"> {{$rows['site_name']}} </a> </td>
                <!-- <td> {{$rows['description']}} </td> -->
                <td>
                    @if ($rows['industry'])
                        <a href="/website/hangye/{{$rows['industry']}}">
                        {{$rows['industry']}} 
                        </a> 
                    @else
                        --
                    @endif
                </td>
                <td> 
                    @if ($rows['area'])
                        <a href="/website/diqu/{{$rows['area']}}">
                        {{$rows['area']}} 
                        </a> 
                    @else
                        --
                    @endif
                </td>
                <td> {{$rows['alexa_rank']}} </td>
                <td> {{$rows['baidu_rank']}} </td>

            </tr>
        @endforeach
        </table>

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