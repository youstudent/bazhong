@extends('layouts.app')
@section('title')
    用户资料修改
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            资料修改
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">资料修改</a></li>
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
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/admin/client_users/edit')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">用户名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="用户名" value="{{$data['name']}}" required>
                            </div>
                            <label for="phone" class="col-sm-1 control-label">电话<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="phone" class="form-control" id="phone" pattern="(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$" placeholder="请输入电话" required value="{{$data['phone']}}" >
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">性别<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <select class="form-control" name="sex">
                                    @foreach(config('language.sex') as $key=> $value)
                                        <option {{$data['sex']==$key?'selected':''}} value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="lastnames" class="col-sm-1 control-label">用户类型<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <select class="form-control" name="identity_type">
                                    @foreach(config('language.identity_type') as $key=> $value)
                                        <option {{$data['identity_type']==$key?'selected':''}} value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="headimgurl" class="col-sm-2 control-label">头像<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="headimgurl" class="file" type="file" accept="image/*">
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
       const shop = '/storage'+"{{$data['headimgurl']}}";
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
