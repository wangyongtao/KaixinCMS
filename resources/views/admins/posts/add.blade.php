{{--  --}}

@extends('admins.layouts.home')
 

@section('sidebar')
    @parent

    <ul class="list-group">
    @foreach ($categoryList as $rows)
        <a href="/article/category-{{ $rows['category_name_en'] }}">
            <li class="list-group-item">
                <strong> {{ $rows['category_name'] }} </strong>
                <span class="badge">{{ isset($categoryCount[$rows['category_name_en']]) ? $categoryCount[$rows['name_en']] : '' }}</span>
            </li>
        </a>
    @endforeach
</ul>

@endsection

@section('content')


<ol class="breadcrumb">
  <li><a href="/">首页</a></li>
  <li><a href="/article/all" class="active">文章列表</a></li>
</ol>


    <h2>文章添加</h2>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">文章添加</h3>
        </div>
        <div class="panel-body">
        <form id="myForm" accept-charset="UTF-8" class="simple_form form-horizontal" method="post" novalidate="novalidate">
            {{ csrf_field() }}
            <input type="hidden" name="form_action" value="">
 
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
                            <option value="{{ $rows['category_name_en'] }}"> {{ $rows['category_name'] }} ({{ $rows['category_name_en'] }}) </option>
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
                    <button id="FormCommitBtn" type="button" name="commit" class="btn btn-success">确认添加</button>
                </div>
            </div>
        </form>

        </div>
    </div>
@endsection