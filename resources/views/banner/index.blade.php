@extends('layouts.app')
@section('title')
    商家管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            广告位
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">广告位列表</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="margin-top: 10px">
                    </div>
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered text-center table-striped">
                            <tr>
                                <th>序号</th>
                                <th>显示位置</th>
                                <th>显示顺序</th>
                                <th>宣传主题</th>
                                <th>图片(点击放大)</th>
                                <th>参与商家</th>
                                <th>广告分类</th>
                                <th>是否报名</th>
                                <th>显示时间</th>
                                <th>更新时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            <?php $i=1?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['show_position']==1?'顶部':'中部'}}</td>
                                    <td>{{$data['sort']}}</td>
                                    <td>{{$data['theme']}}</td>
                                    <td><a hrefs="/storage{{$data['img']}}" class="qrcode"><img style="width: 100px;height: 40px" src="/storage{{$data['img']}}"></a></td>
                                    <td><a hrefs="{{$data['business_id']}}" class="business">查看</a></td>
                                    <td>{{$category[$data['category_id']]}}</td>
                                    <td>{{$data['is_sign_up']==1?'是':'否'}}</td>
                                    <td>{{$data['show_start_time'].' - '.$data['show_end_time']}}</td>
                                    <td>{{$data['updated_at']}}</td>
                                    <td>
                                        @if($data['status'] ==1)
                                            <i class="fa fa-check text-success text-active"></i>
                                        @else
                                            <i class="fa fa-times text-danger text"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('/admin/banner/edit')}}?id={{$data['id']}}" class="btn btn-default btn-sm"><i class="fa fa-fw fa-pencil"></i>修改</a>&nbsp;
                                        @if($data['is_sign_up']==1)
                                            <a href="{{url('/admin/banner/record')}}?select=banner_id&keyword={{$data['id']}}" class="btn btn-default btn-sm"><i class="fa fa-fw fa-folder-open-o"></i>报名详情</a>
                                        @endif
                                    </td>
                                </tr>
                            <?php $i++?>
                            @endforeach
                        </table>
                        {{--<hr style="height:1px;border:none;border-top:1px dashed lavender;" />--}}
                        {{--<div class="panel panel-info">--}}
                            {{--<div class="panel-heading">--}}
                                {{--<h3 class="panel-title">App启动广告</h3>--}}
                            {{--</div>--}}
                            {{--<div class="panel-body">--}}
                                {{--<input id="file-1" name="remarks" class="file" type="file" accept="image/png,image/gif,image/jpg">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- /.box -->
            </div>
        </div>

    </section>
@endsection
@section('script')
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.js" type="text/javascript"></script>
    <script src="/js/fileinput_locale_de.js" type="text/javascript"></script>
    <script>
        //logo图片
        const shop = '/storage'+"{{$homeImg['remarks']}}";
        const id = "{{$homeImg['id']}}";
        $("#file-1").fileinput({
            uploadUrl: '/admin/banner/home?id='+id, //上传的地址
            layoutTemplates :{
                actionUpload:'',//去除上传预览缩略图中的上传图片
                actionZoom:''  //去除上传预览缩略图中的查看详情预览的缩略图标。
            },
            //showUpload:false,
            initialPreview: [ //预览图片的设置
                "<img  src='" + shop + "' class='file-preview-image' alt='肖像图片' title='肖像图片'>",
            ]
        });
        //商家列表
        $(".business").click(function () {
            var data = $(this).attr("hrefs");
            layer.open({
                title:'参与商家列表',
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['300px', '200px'], //宽高
                content: "商家名 : "+data
            });
        });
    </script>

    @endsection