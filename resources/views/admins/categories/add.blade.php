@extends('admins.layouts.home')

@section('sidebar')
    @parent

  

@endsection

@section('content')

<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/admins/categories">分类</a></li>
  <li><a href="#" class="active">新增</a></li>
</ol>

<!-- umeditor
================================================== -->
<link href="/assets/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script src="/assets/umeditor/third-party/template.min.js" type="text/javascript"></script>
<script src="/assets/umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="/assets/umeditor/umeditor.min.js" type="text/javascript"></script>
<script src="/assets/umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>

<div class="main">


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">新增分类</h3>
                      <a href="/admins/categories/add" class="btn btn-xs btn-success">新增分类</a>

        </div>
        <div class="panel-body">
         
        	<?php echo formBuilder('category', '', $options)?>

        </div>
    </div>
</div>
 
<!-- JavaScript 
==========================================================-->
<script type="text/javascript">
 
var requestUrl = '/admins/categories/add';
// Specify a function to execute when the DOM is fully loaded.
$( document ).ready(function() {

    //页面加载完毕，结束进度条
    // TopProgressBar.finish();

    $("#formSubmitBtn").click(function(){

        // var html = UM.getEditor('myEditor').getContent();
        // $('#content').val(html);
        // console.log($('#content').val());

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
                    window.location.href = '/admins/categories/edit/' + result.data;
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