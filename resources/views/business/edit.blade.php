@extends('layouts.app')
@section('title')
    商家管理
@endsection
<?php $img?>
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            商家更新
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">商家更新</a></li>
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
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/admin/business/edit')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">店铺地址</label>
                            <div class="col-sm-7">
                                <input type="text" name="shop_position" class="form-control" id="shop_position" placeholder="请输入店铺地址" value="{{$data['shop_position']}}">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="请输入邮箱" value="{{$data['email']}}">
                            </div>
                            <label for="phone" class="col-sm-1 control-label">电话<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="phone" class="form-control" id="phone" pattern="(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$" placeholder="请输入电话" required value="{{$data['phone']}}" >
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">销售分类</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="category_id">
                                    @foreach($category as $value)
                                        <option {{$data['category_id']==$value['id']? 'selected':''}} value="{{$value['id']}}">{{$value['category_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="lastnames" class="col-sm-1 control-label">销售类型</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="sales_type">
                                    @foreach(config('language.sales_type') as $key=> $value)
                                        <option {{$data['sales_type']==$key?'selected':''}} value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">店铺名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="请输入店铺名" required value="{{$data['name']}}">
                            </div>
                            <label for="password" class="col-sm-1 control-label">密码<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="password" name="password" id="password" required class="form-control text-danger" placeholder="请输输入密码" value="{{$data['password']}}">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="intro" class="col-sm-2 control-label">简介</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" name="intro" id="intro" rows="3" placeholder="Enter ...">{{$data['shop_position']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">logo图片<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="shop_img" class="file" type="file" accept="image/png,image/gif">
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
                                <button type="submit" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i>修改</button>
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
       var a = "{{$errors->first()}}";
       if (a){
           layer.msg(a+'!!', {icon: 5})
       }
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
       $("#file-2").fileinput({
           language: 'zh',
           uploadUrl: '#', // you must set a valid URL here else you will get an error
           allowedFileExtensions : ['jpg', 'png','gif'],
           showPreview: true,
           overwriteInitial: false,
           maxFileSize: 1000,
           initialPreviewAsData: true,
           maxFilesNum: 10,
           showUpload:false,
           layoutTemplates :{
               actionUpload:'',//去除上传预览缩略图中的上传图片
               actionZoom:''   //去除上传预览缩略图中的查看详情预览的缩略图标。
           },
           initialPreview: [ //预览图片的设置
               <?php foreach ($img as $value){
               echo "\""."<img src='/storage{$value['img']}' class='file-preview-image' alt='肖像图片' title='肖像图片'>"."\"".",";
               }
           ?>
           ],
           initialPreviewConfig: [ //配置预览中的一些参数
               <?php foreach ($img as $value){
                  echo "{caption: 'transport-1.jpg', size: 329892, width: '120px', url: '/admin/business/del', key: {$value['id']}}".",";
               }
               ?>

           ],
       });
    </script>
@endsection
