@extends('default.layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            <h2>503 Service Unavailable</h2>
            <p>页面出错了，请确认您输入的URL是否正确.</p>
            <br />
            <p class="text-muted">
                <strong>可能的原因: </strong><br />
                1. 手抖打错了链接地址... <br/>
                2. 链接地址过了保质期...
                <br />
                <br />
            </p>
            <p><a class="btn btn-success btn-xs" href="/?source=404" role="button">返回首页</a></p>
        </div>

    </div>
@endsection