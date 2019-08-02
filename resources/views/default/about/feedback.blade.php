{{-- 加载布局模板文件 --}}
@extends('default.layouts.postLayout')

@section('title', config('options.sitename'))

@section('sidebar')
    @parent

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
  <li><a href="/help">帮助中心</a></li>
  <li><a href="/feedback" class="active">意见反馈</a></li>
</ol>

<h3> 用户反馈 </h3>
<form id="addFeedbackForm">
  {{ csrf_field() }}
  <input type="hidden" name="isSubmit" value="1">
  <div class="form-group">
    <label for="exampleInput1">反馈内容</label>
    <textarea id="exampleInput1" rows="5" class="form-control" name="content" placeholder="请输入您的反馈内容..."></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInput2">联系方式</label>
    <input id="exampleInput2" name="contact_info" type="text" class="form-control" id="exampleInput2" placeholder="请输入您的联系方式:手机号、邮箱、QQ等">
  </div> 
  <button type="button" id="AddFeedbackBtn" class="btn btn-success">确认提交</button>
</form>

<br/>
<br/>
<br/>
<br/>

@endsection

@section('pageBottom')
	<script type="text/javascript">
		// -------------------------------------------------------

		$(document).ready(function() {

			$( "#AddFeedbackBtn" ).on( "click", function() {
				console.log( $( this ).text() );
				var $conent = $('#exampleInput1').val();
				if ($conent == '' || $conent.length <= 10 ){
					alert('反馈内容必填, 且需要填写10个字以上哦 ！');
					return false;
				}
				var dataParams = $('#addFeedbackForm').serialize();
				$.ajax({
					url: '/about/feedback/add.html',
					method: "POST",
					data: dataParams,
					dataType: "json"
					//  beforeSend: function( xhr ) {
					//      xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
					// }
				}).done(function( data ) {
					console.log(data);
					if ( data.code == 200 ) {
						alert('谢谢，请的反馈我们已经收到！如果必要，我们会及时与您联系的！');
						window.location.reload();
					}
				}).fail(function( jqXHR, textStatus, textMsg ) {
					alert( "Request failed: [" + textStatus+'] app_' + textMsg );
				})
			});

		});

		// -------------------------------------------------------

	</script>
@endsection