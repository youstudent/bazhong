@extends('agency.layouts.app')
@section('title')
    活动管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            活动修改
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">活动修改</a></li>
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
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/agency/activity/edit')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <div class="form-group">
                            <label for="theme" class="col-sm-2 control-label">活动主题<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="theme" class="form-control" id="theme" value="{{$data['theme']}}" placeholder="请输入活动主题" required>
                            </div>
                            <label for="activity_address" class="col-sm-1 control-label">活动地址<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="activity_address" class="form-control" id="activity_address" value="{{$data['activity_address']}}" placeholder="请输入活动地址" required >
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="activity_date" class="col-sm-2 control-label">活动日期<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="activity_date" class="form-control" id="activity_date" value="{{$data['activity_date']}}" placeholder="请选择活动日期" readonly="readonly" required >
                            </div>
                            <label for="activity_date" class="col-sm-1 control-label">活动时间<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="activity_time" class="form-control" id="activity_time" value="{{$data['activity_time']}}" placeholder="请选择活动时间" required readonly="readonly">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">简介<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <textarea name="content" class="form-control" maxlength="20" id="content"  rows="3" placeholder="活动内容.限定字数20" required>{{$data['content']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">logo图片<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="img" class="file" type="file" accept="image/*" required>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i>确认重新申请</button>
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
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.js" type="text/javascript"></script>
    <script src="/js/fileinput_locale_de.js" type="text/javascript"></script>
    <script>
        //日期时间范围
        laydate.render({
            elem: '#activity_date'
            ,type: 'date'
            ,range: true
            ,btns: ['confirm']
            ,min: '<?php echo $start?>'
            ,max: '<?php echo $end?>'
        });
        //日期时间范围
        laydate.render({
            elem: '#activity_time'
            ,type: 'time'
            ,range: true
            ,btns: ['confirm']
        });
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
@endsection
