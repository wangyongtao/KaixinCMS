{{-- 加载布局模板文件 --}}
@extends('default.layouts.postLayout')

@section('title', "关于我们" .'-'. config('options.sitename'))

@section('sidebar')
    @parent

    <!-- 关于我们 -->
    <div class="list-group">
	  <a href="#" class="list-group-item active">
	    帮助中心
	  </a>
	  <a href="/help/feedback" class="list-group-item"> <strong> > 意见反馈</strong> </a>
	  <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
	  <a href="#" class="list-group-item">Morbi leo risus</a>
	  <a href="#" class="list-group-item">Porta ac consectetur ac</a>
	  <a href="#" class="list-group-item">Vestibulum at eros</a>
	</div>
@endsection

@section('content')

<!-- 路径导航 -->
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/about/about.html" class="active">关于我们</a></li>
</ol>

<div class="panel panel-default">
    <div class="panel-heading"> 关于我们 </div>
    <div class="panel-body">
    笑话111网(XiaoHua111.com), 为广大的网友朋友提供笑话、幽默、短信、搞笑影视台词、搞笑趣图、幽默网文等，希望为广大网友提供开心和快乐。
    </div>
</div>

@endsection