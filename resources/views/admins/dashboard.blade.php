@extends('admins.layouts.home')
 
@section('content')


<ol class="breadcrumb">
  <li><a href="/admins">管理后台</a></li>
  <li><a href="/admins/dashboard" class="active">控制台</a></li>
</ol>

 <div class="">
    <div class="row">
        <div class="col-md-3" style="font-size:12px">
			<div class="panel panel-primary">
			  <div class="panel-heading">
			    <h3 class="panel-title">文章数</h3>
			  </div>
			  <div class="panel-body">
			    
			    <a href="/admins/posts" role="button">
			    	<strong> <?php if(isset($PostCount)){echo $PostCount;}?> </strong>
			    </a>
			  </div>
			</div>
        </div>
        <div class="col-md-3" style="font-size:12px">
			<div class="panel panel-success">
			  <div class="panel-heading">
			    <h3 class="panel-title">分类数</h3>
			  </div>
			  <div class="panel-body">
			    
				<a href="/admins/comments" role="button">
					<strong> <?php if(isset($CategoryCount)){echo $CategoryCount;}?> </strong>
				</a>

			  </div>
			</div>
        </div>
        <div class="col-md-3" style="font-size:12px">
			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">用户数</h3>
			  </div>
			  <div class="panel-body">
			    
				<a href="/admins/links" role="button">
					<strong> <?php if(isset($UserCount)){echo $UserCount;}?> </strong>
				</a>

			  </div>
			</div>
        </div>
        <div class="col-md-3" style="font-size:12px">
			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">链接数</h3>
			  </div>
			  <div class="panel-body">
				<a href="/admins/links" role="button">
					<strong> <?php if(isset($LinkCount)){echo $LinkCount;}?> </strong>
				</a>

			  </div>
			</div>
        </div>
    </div>

</div>



@endsection