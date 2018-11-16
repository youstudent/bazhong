@extends('layouts.app')
@section('title')
    申请管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            申请记录
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">申请记录</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="margin-top: 10px">
                        <form id="lr_form" action="{{url('/admin/client_users/applyRecord')}}" method="get">
                            <div class="form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" id="time" name="time" class="form-control" style="width: 268px" value="{{$time}}"  readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <div class="form-group field-users-select">
                                        <select id="users-select" class="form-control" name="status">
                                            <option value="">全部</option>
                                            @foreach(config('language.status') as $key=>$value)
                                                <option {{request('status')==$key?'selected':''}} value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group field-users-select">
                                        <select id="users-select" class="form-control" name="select">
                                            <option value="1">智能查询</option>
                                            <option {{request('select')=='client_users_id'?'selected':''}} value="client_users_id">用户ID</option>
                                            <option {{request('select')=='name'?'selected':''}} value="name">用户昵称</option>
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
                                        <a class="btn btn-default" href="{{'/admin/client_users/applyRecord'}}">重置</a>
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
                                <th>手机号</th>
                                <th>邮箱</th>
                                <th>身份证</th>
                                <th>经销区域</th>
                                <th>经销类型</th>
                                <th>营业执照(点击放大)</th>
                                <th>状态</th>
                                <th>申请时间</th>
                                <th>操作</th>
                            </tr>
                            <?php $i=1?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['client_users_id']}}</td>
                                    <td>{{$data['name']}}</td>
                                    <td>{{$data['phone']}}</td>
                                    <td>{{$data['email']}}</td>
                                    <td>{{$data['identity']}}</td>
                                    <td>{{$data['business_area_id']}}</td>
                                    <td>{{$data['business_name']}}</td>
                                    <td><a hrefs="/storage{{$data['business_license_img']}}" class="qrcode"><img style="width: 100px;height: 40px" src="/storage{{$data['business_license_img']}}"></a></td>
                                    <td>
                                        @if($data['status'] == 2)
                                            <span class="label bg-success">通过</span>
                                        @elseif($data['status'] == 3)
                                            <span class="label bg-danger">拒绝</span>
                                        @else
                                            <span class="label bg-info">待处理</span>
                                        @endif
                                    </td>
                                    <td>{{$data['created_at']}}</td>

                                    <td>
                                        @if($data['status']==1)
                                            <a hrefs="{{url('/admin/client_users/status')}}/{{$data['id'].'/2'}}" class="btn btn-default btn-sm delete"><i class="fa fa-fw fa-check"></i>通过</a>
                                            <a hrefs="{{url('/admin/client_users/status')}}/{{$data['id']}}/3" class="btn btn-default btn-sm refuse"><i class="fa fa-fw fa-close"></i>拒绝</a>
                                            @else
                                            <span class="label bg-info">已经处理</span>
                                        @endif
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
@section('script')
    <script type="text/javascript">
        //平台用户充值
        $(".refuse").click(function () {
            //询问框
            var url = $(this).attr("hrefs");
            var csrf = "{{csrf_token()}}";
            layer.prompt({
                formType: 2,
                title: '请输入拒绝的理由',
                offset: ['40%', '40%']
            }, function(value, index, elem){
                layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
                $.ajax({
                    url:url,
                    type:'get',
                    data:{remarks:value,'_token':csrf},
                    success:function (res) {
                        layer.close(index);
                        if(res.code == 1)
                        {
                            reload(res.message,1)
                        }else{
                            reload(res.message,5)
                        }
                    }
                });
            });
        });
    </script>
@endsection