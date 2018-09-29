@extends('layouts.app')
@section('title')
    广告位管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            广告位
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">广告位更新</a></li>
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
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/admin/banner/edit')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="form-group">
                            <label for="theme" class="col-sm-2 control-label">宣传主题<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="theme" class="form-control" id="email" placeholder="请输入宣传主题" value="{{$data['theme']}}" required>
                            </div>
                            <label for="time" class="col-sm-1 control-label">显示时间<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="time" class="form-control" id="time" value="{{$data['show_start_time'] .' - '.$data['show_end_time']}}" readonly="readonly" >
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">是否显示</label>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" id="status"
                                               value="1" {{$data['status']==1?'checked':''}}> 是&nbsp;&nbsp;
                                    </label>
                                    <label>
                                        <input type="radio" name="status" id="status"
                                               value="0" {{$data['status']==0?'checked':''}}> 否
                                    </label>
                                </div>
                            </div>
                            <label for="is_sign_up" class="col-sm-3 control-label">是否报名</label>
                            <div class="col-sm-3">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_sign_up" id="is_sign_up"
                                               value="1" {{$data['is_sign_up']==1?'checked':''}}> 是&nbsp;&nbsp;
                                    </label>
                                    <label>
                                        <input type="radio" name="is_sign_up" id="is_sign_up"
                                               value="0" {{$data['is_sign_up']==0?'checked':''}}> 否
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastnames" class="col-sm-2 control-label">显示顺序</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="sort">
                                    @foreach(config('language.sort') as $key=> $value)
                                        <option {{$key==$data['sort']?'selected':''}} value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">logo图片<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="img" class="file" type="file" accept=".png,.gif,.jpg">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="ue-container" class="col-sm-2 control-label">广告详情<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <script id="ue-container" name="content"  type="text/plain">
                                    @php
                                        echo htmlspecialchars_decode($data['content']);
                                    @endphp
                                </script>
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
       var a = "{{$errors->first()}}";
       if (a){
           layer.msg(a+'!!', {icon: 5})
       }
       //logo图片
       const shop = '/storage'+"{{$data['img']}}";
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
        <!-- ueditor-mz 配置文件 -->
        <script type="text/javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="{{asset('ueditor/ueditor.all.js')}}"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('ue-container');
            ue.ready(function(){
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
            });
        </script>
@endsection
