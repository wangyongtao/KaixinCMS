{{-- 加载布局模板文件 --}}
@extends('default.layouts.postLayout')

@section('title', 'Greeting - Xiaohua111.com')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')


<!-- 路径导航 -->
<ol class="breadcrumb">
  <li><a href="/">Home</a></li>
  <li><a href="/about">关于我们</a></li>
  <li><a href="/feedback" class="active">免责声明</a></li>
</ol>

    <h2>免责声明</h2>
    <p>请务必仔细阅读本条款并同意本声明。</p>
    <p>
    	本网站提供的内容仅用于个人学习、研究或欣赏。我们不保证内容的正确性。通过使用本站内容随之而来的风险与本站无关。
        访问者可将本网站提供的内容或服务用于个人学习、研究或欣赏，以及其他非商业性或非盈利性用途，但同时应遵守著作权法及其他相关法律的规定，不得侵犯本网站及相关权利人的合法权利。
    </p>
    <p>本网站内容原作者如不愿意在本网站刊登内容，请及时通知本站，予以删除。</p>
@endsection