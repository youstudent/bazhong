@extends('layouts.app')
@section('title')
    分类管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            分类管理
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">分类管理</a></li>
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
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/admin/business/categoryEdit')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="form-group">
                            <label for="category_name" class="col-sm-2 control-label">分类名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="category_name" class="form-control" id="category_name" placeholder="请输入分类名" value="{{$data['category_name']}}" required>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">icon图标<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="icon" class="file" type="file" accept="image/*">
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
        <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="/js/fileinput.js" type="text/javascript"></script>
        <script src="/js/fileinput_locale_de.js" type="text/javascript"></script>
    <script>
       var a = "{{$errors->first()}}";
       if (a){
           layer.msg(a+'!!', {icon: 5})
       }
       //logo图片
       const shop = '/storage'+"{{$data['icon']}}";
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
