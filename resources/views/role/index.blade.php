@extends('layouts.app')
@section('title')
    角色管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            角色列表
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">角色列表</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header" style="margin-top: 10px">
                        <a href="{{url('/admin/business/create')}}" class="btn btn-default pull-right"> <i class="fa fa-plus"></i> &nbsp;添加</a>
                    </div>
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered text-center table-striped">
                            <tr>
                                <th>序号</th>
                                <th>名字</th>
                                <th>描述</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            <?php $i=1?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['name']}}</td>
                                    <td>{{$data['description']}}</td>
                                    <td>{{$data['created_at']}}</td>
                                    <td>
                                        <a href="{{url('/admin/business/edit')}}?id={{$data['id']}}" class="btn btn-default btn-sm"><i class="fa fa-fw fa-pencil"></i>修改</a>&nbsp;
                                        <a hrefs="{{url('/admin/business/delete')}}/{{$data['id']}}" class="btn btn-default btn-sm delete"><i class="fa fa-fw fa-trash"></i>删除</a>
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