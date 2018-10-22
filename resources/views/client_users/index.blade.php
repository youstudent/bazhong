@extends('layouts.app')
@section('title')
    玩家管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            玩家列表
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">玩家列表</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="margin-top: 10px">
                        <form id="lr_form" action="{{url('/admin/client_users/index')}}" method="get">
                            <div class="form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" id="time" name="time" class="form-control" style="width: 268px" value="{{$time}}"  readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <div class="form-group field-users-select">
                                        <select id="users-select" class="form-control" name="select">
                                            <option value="1">智能查询</option>
                                            <option {{request('select')=='phone'?'selected':''}} value="phone">手机号</option>
                                            <option {{request('select')=='name'?'selected':''}} value="name">用户名</option>
                                            <option {{request('select')=='users_id'?'selected':''}} value="users_id">用户ID</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="form-group field-users-keyword">
                                            <input type="text" id="test1" class="form-control" name="keyword" value="{{request('keyword')}}" placeholder="请输入查询内容">
                                        </div>
                                        <span class="input-group-btn">
                                         <button class="btn btn-default" type="submit"><i class="fa fa-search"></i>&nbsp;搜索</button>

                                        </span>
                                        <a class="btn btn-default" href="{{'/admin/client_users/index'}}">重置</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered text-center table-striped">
                            <tr>
                                <th>序号</th>
                                <th>用户ID</th>
                                <th>用户名</th>
                                <th>电话</th>
                                <th>性别</th>
                                <th>头像(点击放大)</th>
                                <th>生日</th>
                                <th>用户类型</th>
                                <th>注册时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            <?php $i=1?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['users_id']}}</td>
                                    <td>{{$data['name']}}</td>
                                    <td>{{$data['phone']}}</td>
                                    <td>{{$data['sex']==1?'男':'女'}}</td>
                                    <td><a hrefs="/storage{{$data['headimgurl']}}" class="qrcode"><img style='width: 50px;height: 50px' src='/storage{{$data['headimgurl']}}' alt=''></a></td>
                                    <td>{{$data['birthday']}}</td>
                                    <td>{{$data['identity_type']?$data['identity_type']:'普通用户'}}</td>
                                    <td>{{$data['created_at']}}</td>
                                    <td>
                                        @if($data['status'] ==1)
                                            <i class="fa fa-check text-success text-active"></i>
                                        @else
                                            <i class="fa fa-times text-danger text"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{url('/admin/client_users/edit')}}?id={{$data['id']}}" class="btn btn-info btn-sm">修改</a>&nbsp;
                                    </td>
                                </tr>
                            <?php $i++?>
                            @endforeach
                        </table>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    </div>
                    <div class="text-center">
                        {!!$datas->render() !!}
                    </div>

                    <!-- /.box-body -->
                </div>

                <!-- /.box -->
            </div>
        </div>

    </section>
@endsection