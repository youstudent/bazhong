@extends('layouts.app')
@section('title')
    打卡管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            打卡记录
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">打卡记录</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="margin-top: 10px">
                        <form id="lr_form" action="{{url('/admin/client_users/cardRecord')}}" method="get">
                            <div class="form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" id="time" name="time" class="form-control" style="width: 268px" value="{{$time}}"  readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <div class="form-group field-users-select">
                                        <select id="users-select" class="form-control" name="select">
                                            <option value="1">智能查询</option>
                                            <option {{request('select')=='client_users_id'?'selected':''}} value="client_users_id">用户ID</option>
                                            <option {{request('select')=='client_users_name'?'selected':''}} value="client_users_name">用户昵称</option>
                                            <option {{request('select')=='shop_id'?'selected':''}} value="shop_id">商家ID</option>
                                            <option {{request('select')=='business_name'?'selected':''}} value="business_name">商家昵称</option>
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
                                        <a class="btn btn-default" href="{{'/admin//client_users/cardRecord'}}">重置</a>
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
                                <th>用户昵称</th>
                                <th>商家ID</th>
                                <th>店铺名</th>
                                <th>打卡时间</th>
                                <th>票据</th>
                            </tr>
                            <?php $i=1?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['client_users_id']}}</td>
                                    <td>{{$data['client_users_name']}}</td>
                                    <td>{{$data['shop_id']}}</td>
                                    <td>{{$data['business_name']}}</td>
                                    <td>{{$data['created_at']}}</td>
                                    <td><img style="width: 100px;height: 40px" src="/storage{{$data['img']}}"></td>
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