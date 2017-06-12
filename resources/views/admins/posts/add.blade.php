{{--  --}}

@extends('admins.layouts.home')
 

@section('sidebar')
    @parent

    <ul class="list-group">
        <li class="list-group-item active">文章管理</li>
        @foreach ($categoryList as $rows)
            <li class="list-group-item">
                <a href="/admins/posts?category={{ $rows['category_name_en'] }}">
                    <strong> {{ $rows['category_name'] }} </strong>
                    <span class="badge">{{ isset($categoryCount[$rows['category_name_en']]) ? $categoryCount[$rows['name_en']] : '' }}</span></a>
            </li>
            
        @endforeach
    </ul>

@endsection

@section('content')


<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/admins/posts">文章列表</a></li>
  <li><a href="/admins/posts/add" class="active">新增</a></li>
</ol>

<!-- umeditor
================================================== -->
<link href="/assets/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script src="/assets/umeditor/third-party/template.min.js" type="text/javascript"></script>
<script src="/assets/umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="/assets/umeditor/umeditor.min.js" type="text/javascript"></script>
<script src="/assets/umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>


    <h2>文章添加</h2>

    <div class="panel panel-default">
        <div class="panel-heading">
            <a class="panel-title">文章添加</a>
            <a href="/admins/posts/add" class="btn btn-xs btn-success">  新增文章 </a>
        </div>
        <div class="panel-body">
        <form id="myForm" accept-charset="UTF-8" class="simple_form form-horizontal" method="post" novalidate="novalidate">
            {{ csrf_field() }}
            <input type="hidden" name="form_action" value="">
 
            <div class="form-group">
                <label class="col-md-2 control-label" for="title">文章标题</label>
                <div class="col-md-10">
                    <input placeholder="网站名称" class="form-control" id="title" name="title" size="50" type="text" value="<?php if(isset($detail['title'])){echo $detail['title'];}?>" />
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-md-2 control-label" for="source_link">来源链接</label>
                <div class="col-md-10">
                    <input placeholder="网站链接" class="form-control" id="source_link" name="source_link" size="50" type="text" value="<?php if(isset($detail['source_link'])){echo $detail['source_link'];}?>" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="link_url">文章分类</label>
                <div class="col-md-10">
                    <select class="form-control" id="category" name="category">
                        @foreach ($categoryList as $rows)
                            <option value="{{ $rows['category_name_en'] }}"> {{ $rows['category_name'] }} ({{ $rows['category_name_en'] }}) </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="
                ">文章内容</label>
                <div class="col-md-10">
                    <textarea id="content" name="content" style="display: none;"> <?php if(isset($detail['content'])){echo $detail['content'];}?> </textarea>

                    <!-- 加载编辑器的容器 -->
                    <script type="text/plain" id="myEditor" style="width:100%;height:240px;">
                        <div><?php if(isset($detail['content'])){echo $detail['content'];}?></div>
                    </script>
                </div>
                
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="user_account_attributes_location">显示/隐藏</label>
                <div class="col-md-10">
                    <label class='radio-inline'>
                        <input checked="checked" id="settings_show_community_stats_on" name="is_hidden" type="radio" value="0" />显示</label>
                    <label class='radio-inline'>
                        <input id="settings_show_community_stats_off" name="is_hidden" type="radio" value="1" />隐藏</label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button id="FormCommitBtn" type="button" name="commit" class="btn btn-success">确认添加</button>
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



var requestUrl = '/admins/posts/add';
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
                    window.location.href = '/admins/posts/edit/' + result.data;
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