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
            <li><a href="#">分类列表</a></li>
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
                                <th>分类名</th>
                                <th>图标(点击放大)</th>
                                <th>更新时间</th>
                                <th>操作</th>
                            </tr>
                            <?php $i=1?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{str_repeat('--', $data['level']).' '.$data['category_name']}}</td>
                                    <td><a hrefs="/storage{{$data['icon']}}" class="qrcode"><img style="width: 100px;height: 40px" src="/storage{{$data['icon']}}"></a></td>
                                    <td>{{$data['updated_at']}}</td>
                                    <td>
                                        @if($data['pid']==0)
                                            <a href="{{url('/admin/business/categoryCreate')}}?id={{$data['id']}}" class="btn btn-default btn-sm"><i class="fa fa-plus"></i>创建</a>&nbsp;
                                        @endif
                                        @if($data['pid']!==0)
                                                <a href="{{url('/admin/business/categorySonEdit')}}?id={{$data['id']}}" class="btn btn-default btn-sm"><i class="fa fa-fw fa-pencil"></i>修改</a>&nbsp
                                                <a hrefs="{{url('/admin/business/categoryDelete')}}/{{$data['id']}}" class="btn btn-default btn-sm delete"><i class="fa fa-fw fa-trash"></i>删除</a>
                                        @else
                                          <a href="{{url('/admin/business/categoryEdit')}}?id={{$data['id']}}" class="btn btn-default btn-sm"><i class="fa fa-fw fa-pencil"></i>修改</a>&nbsp;
                                        @endif

                                    </td>
                                </tr>
                            <?php $i++?>
                            @endforeach
                        </table>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- /.box -->
            </div>
        </div>

    </section>
@endsection