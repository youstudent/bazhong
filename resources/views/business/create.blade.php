@extends('layouts.app')
@section('title')
    商家管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            商家添加
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">商家添加</a></li>
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
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/admin/business/create')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="shop_id" value="">
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">店铺地址</label>
                            <div class="col-sm-7">
                                <input type="text" name="shop_position" class="form-control" id="shop_position" placeholder="请输入店铺地址">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="请输入邮箱">
                            </div>
                            <label for="phone" class="col-sm-1 control-label">电话<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="phone" class="form-control" id="phone" pattern="(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$" placeholder="请输入电话" required >
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">销售分类</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="category_id">
                                    @foreach($category as $value)
                                        <option value="{{$value['id']}}">{{$value['category_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="lastnames" class="col-sm-1 control-label">销售类型</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="sales_type">
                                    @foreach(config('language.sales_type') as $key=> $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">店铺名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="请输入店铺名" required>
                            </div>
                            <label for="password" class="col-sm-1 control-label">密码<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="password" name="password" id="password" required class="form-control text-danger" placeholder="请输输入密码">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="intro" class="col-sm-2 control-label">简介</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" id="intro" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">logo图片<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="shop_img" class="file" type="file" accept="image/png,image/gif,image/jpg" required>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">广告图片</label>
                            <div class="col-sm-7">
                                <input id="file-2" name="files[]" type="file" multiple class="file"  data-upload-url="#" data-min-file-count="10">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">添加</button>
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
    <link href=" /css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.js" type="text/javascript"></script>
    <script src="/js/fileinput_locale_de.js" type="text/javascript"></script>
    <script>
       var a = "{{$errors->first()}}";
       if (a){
           layer.msg(a+'!!', {icon: 5})
       }
       var url1 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg';
       $("#file-2").fileinput({
           uploadUrl: '#', // you must set a valid URL here else you will get an error
           allowedFileExtensions : ['jpg', 'png','gif'],
           language: 'zh',
           showPreview: true,
           overwriteInitial: false,
           maxFileSize: 1000,
           initialPreviewAsData: true,
           maxFilesNum: 10,
           showUpload:false,
           initialPreviewConfig: [
               {caption: "Moon.jpg", downloadUrl: url1, size: 930321, width: "120px", key: 1}
           ],
               slugCallback: function(filename) {
               return filename.replace('(', '_').replace(']', '_');
           }
       });
    </script>
@endsection
