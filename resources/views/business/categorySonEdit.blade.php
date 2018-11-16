@extends('layouts.app')
@section('title')
    分类管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            修改子分类
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">修改子分类</a></li>
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
                    <form class="form-horizontal" method="post" role="form"  action="{{url('/admin/business/categorySonEdit')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="form-group">
                            <label for="suggestId" class="col-sm-2 control-label">子分类名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7" id="category_name">
                                <input type="text" name="category_name" id="category_name" class="form-control" value="{{$data['category_name']}}"  placeholder="请输入分类名" required>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">父级分类<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <select class="form-control" name="category_id">
                                    @foreach($category as $value)
                                        <option {{$data['pid']==$value['id']?'selected':''}} value="{{$value['id']}}">{{$value['category_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info"><i class="fa fa-fw fa-pencil"></i>修改</button>
                            </div>
                        </div>
                        <p class="page-header"></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
