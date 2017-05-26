{{-- 文章编辑页面 --}}

@extends('admins.layouts.home')


@section('content')


<!-- umeditor
================================================== -->
<link href="/assets/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script src="/assets/umeditor/third-party/template.min.js" type="text/javascript"></script>
<script src="/assets/umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="/assets/umeditor/umeditor.min.js" type="text/javascript"></script>
<script src="/assets/umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>

 
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">文章编辑 (<?php if(isset($detail['id'])){echo $detail['id'];}?>)</h3>
        </div>
        <div class="panel-body">
        <form id="myForm" accept-charset="UTF-8" class="simple_form form-horizontal" method="post" novalidate="novalidate">
            {{ csrf_field() }}
            <input type="hidden" name="form_action" value="">
            <input type="hidden" name="id" value="<?php if(isset($detail['id'])){echo $detail['id'];}?>">
            <div class="form-group">
                <label class="col-md-3 control-label" for="title">文章编号</label>
                <div class="col-md-8">
                    <input  class="form-control" type="text" disabled="disabled" value="<?php if(isset($detail['id'])){echo $detail['id'];}?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="title">文章标题</label>
                <div class="col-md-8">
                    <input placeholder="网站名称" class="form-control" id="title" name="title" size="50" type="text" value="<?php if(isset($detail['title'])){echo $detail['title'];}?>" />
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-md-3 control-label" for="source">来源链接</label>
                <div class="col-md-8">
                    <input placeholder="网站链接" class="form-control" id="source" name="source" size="50" type="email" value="<?php if(isset($detail['source'])){echo $detail['source'];}?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="link_url">文章分类</label>
                <div class="col-md-8">
                    <select class="form-control" id="category" name="category">
                        @foreach ($categoryList as $rows)
                            <option value="{{ $rows['category_name_en'] }}" <?php if($detail['category']==$rows['category_name_en']){echo 'selected="selected"';}?>>
                            {{ $rows['category_name'] }} ({{ $rows['category_name_en'] }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

 
            <div class="form-group">
                <label class="col-md-3 control-label" for="
                ">文章内容</label>
                <div class="col-md-8">
                    <textarea id="content" name="content" style="display: none;"> <?php if(isset($detail['content'])){echo $detail['content'];}?> </textarea>
                </div>
                <!-- 加载编辑器的容器 -->
                <script type="text/plain" id="myEditor" style="width:800px;height:240px;">
                    <div><?php if(isset($detail['content'])){echo $detail['content'];}?></div>
                </script>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="user_account_attributes_location">显示/隐藏</label>
                <div class="col-md-8">
                    <label class='radio-inline'>
                        <input checked="checked" id="settings_show_community_stats_on" name="is_hidden" type="radio" value="0" />显示</label>
                    <label class='radio-inline'>
                        <input id="settings_show_community_stats_off" name="is_hidden" type="radio" value="1" />隐藏</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button id="FormCommitBtn" type="button" name="commit" class="btn btn-success">保存修改</button>
                </div>
            </div>
        </form>

        </div>
    </div>
 
<!-- JavaScript 
==========================================================-->
<script type="text/javascript">

$( document ).ready(function() {

    var UMConfig = {
        toolbars: [
            ['fullscreen', 'source', 'undo', 'redo', 'bold']
        ],
        autoHeightEnabled: true,
        autoFloatEnabled: true
    };
    var UMEditor = UM.getEditor('myEditor', UMConfig);


});


//设置进度条选项
var options = {
  id: 'top-progress-bar',
  color: '#018865',
  height: '3px',
  duration: 0.8
}
//初始化进度条
// var TopProgressBar = new ToProgress(options);
//设置初始进度条长度
// TopProgressBar.setProgress(30);

var requestUrl = '/article/edit/{{$detail['id']}}';
// Specify a function to execute when the DOM is fully loaded.
$( document ).ready(function() {

    //页面加载完毕，结束进度条
    // TopProgressBar.finish();

    $("#FormCommitBtn").click(function(){

        var html = UM.getEditor('myEditor').getContent();
        $('#content').val(html);
        console.log($('#content').val());

        // TopProgressBar.setProgress(30);
        //progressBar.increase(15);
        if ($('#title').val() == ''){
            alert('标题不能为空');
            return false;
        }
        if ($('#content').val() == ''){
            alert('内容不能为空');
            return false;
        }

        var dataParams = $('#myForm').serialize();

        $.ajax({
            url: requestUrl,
            method: 'POST',
            data: dataParams,
            dataType:'json',
            success: function(result) {
                //progressBar.setProgress(30);
                // TopProgressBar.finish();

                console.log(result);
                console.log(result.msg);
                //window.location.reload();

                if( result.code == 1 ){            
                    window.location.href = result.data;
                } else {
                    alert(result.msg);
                    window.location.reload();
                }
                // window.location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("操作失败，请稍后重试！");
                console.log(XMLHttpRequest.status);
                console.log(XMLHttpRequest.readyState);
                console.log(textStatus);
            }
        });
        //$("#myDiv").html(htmlobj.responseText);
    });

});
</script>


@endsection