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
                                <th>图片</th>
                                <th>参与商家</th>
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
                                    <td><img style="width: 100px;height: 40px" src="/storage{{$data['img']}}"></td>
                                    <td>{{$data['business_id']}}</td>
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
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <img style="width: 50%;height: 50%" src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1538108801476&di=bf7596e109931e42138485238cfc6ed8&imgtype=0&src=http%3A%2F%2Fimg.zcool.cn%2Fcommunity%2F0339339554c740000000158fc6fe40c.jpg%40600w_1l_2o_100sh.jpg">
                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- /.box -->
            </div>
        </div>

    </section>
@endsection