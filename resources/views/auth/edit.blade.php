@extends('layouts.app')
@section('title')
    管理员修改
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            管理员修改
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">管理员修改</a></li>
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
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/admin/edit')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">名字<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" value="{{$data['name']}}" name="name" class="form-control" id="name" required>
                            </div>
                            <label for="email" class="col-sm-1 control-label">邮箱<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="email" value="{{$data['email']}}" name="email" class="form-control" id="email" required>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">新密码<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="password" name="new_password" class="form-control" id="new_password" required placeholder="修改请填写!">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i>修改</button>
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
