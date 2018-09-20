@extends('agency.layouts.app')

@section('title')
    商家首页
@endsection()

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            商家首页
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>商家首页</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">消息</span>
                        <span class="info-box-number">{{$emailCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">活动数量</span>
                        <span class="info-box-number">{{$activityCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">上线活动</span>
                        <span class="info-box-number">{{$activityIngCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">拒绝活动</span>
                        <span class="info-box-number">{{$activityRefuseCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">店铺信息</h3>
                    </div>
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/agency/index/index')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">店铺名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="name" class="form-control" value="{{$data['name']}}" id="name" placeholder="请输入店铺名" required>
                            </div>
                            <label for="shop_position" class="col-sm-1 control-label">店铺地址<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="shop_position" class="form-control" id="shop_position" value="{{$data['shop_position']}}" placeholder="请输入店铺地址" required >
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="intro" class="col-sm-2 control-label">简介<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <textarea name="intro" class="form-control" id="intro" rows="3" placeholder="简介内容" required>{{$data['intro']}}</textarea>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="file-1" class="col-sm-2 control-label">logo图片<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="shop_img" class="file" type="file" accept="image/png,image/gif,image/jpg">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">修改</button>
                            </div>
                        </div>
                        <p class="page-header"></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <link href=" /css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.js" type="text/javascript"></script>
    <script src="/js/fileinput_locale_de.js" type="text/javascript"></script>
    <script>
        //logo图片
        const shop = '/storage'+"{{$data['shop_img']}}";
        $("#file-1").fileinput({
            layoutTemplates :{
                actionUpload:'',//去除上传预览缩略图中的上传图片
                actionZoom:''  //去除上传预览缩略图中的查看详情预览的缩略图标。
            },
            showUpload:false,
            initialPreview: [ //预览图片的设置
                "<img  src='" + shop + "' class='file-preview-image' alt='肖像图片' title='肖像图片'>",
            ]
        });
    </script>
@endsection