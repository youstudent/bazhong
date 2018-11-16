@extends('layouts.app')
@section('title')
    添加管理员
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            添加管理员
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">添加管理员</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('admin/admin/create')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">用户名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="请输入用户名" required>
                            </div>
                            <label for="password" class="col-sm-1 control-label">密码<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="password" name="password" id="password" required class="form-control text-danger" placeholder="请输输入密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="请输入邮箱" required>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i> 确认</button>
                            </div>
                        </div>
                        <p class="page-header"></p>
                    </form>
                </div>
            </div>
        </div>
        <div class="container kv-main">

        </div>
    </section>
@endsection
@section('script')
@endsection
