@extends('layouts.app')
@section('title')
    商家管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            商家列表
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">商家列表</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="margin-top: 10px">
                        <form id="lr_form" action="{{url('/admin/business/index')}}" method="get">
                            <div class="form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" id="time" name="time" class="form-control" style="width: 268px" value="{{$time}}"  readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <div class="form-group field-users-select">
                                        <select id="users-select" class="form-control" name="category_id">
                                            <option value="">选择分类</option>
                                            @foreach($category as $value)
                                                <option {{request('category_id')==$value['id']?'selected':''}} value="{{$value['id']}}">{{$value['category_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group field-users-select">
                                        <select id="users-select" class="form-control" name="select">
                                            <option value="1">智能查询</option>
                                            <option {{request('select')=='phone'?'selected':''}} value="phone">手机号</option>
                                            <option {{request('select')=='name'?'selected':''}} value="name">店铺名</option>
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
                                        <a class="btn btn-default" href="{{'/admin/business/index'}}">重置</a>
                                    </div>
                                </div>
                                <a href="{{url('/admin/business/create')}}" class="btn btn-default pull-right"> <i class="fa fa-plus"></i> &nbsp;添加</a>
                            </div>
                        </form>

                    </div>
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered text-center table-striped">
                            <tr>
                                <th>序号</th>
                                <th>商家ID</th>
                                <th>店铺名</th>
                                <th>分类</th>
                                <th>电话</th>
                                <th>logo</th>
                                <th>邮箱</th>
                                <th>创建时间</th>
                                <th>访问量</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            <?php $i=1?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['shop_id']}}</td>
                                    <td>{{$data['name']}}</td>
                                    <td>{{$data['category']['category_name']}}</td>
                                    <td>{{$data['phone']}}</td>
                                    <td><img style="width: 100px;height: 40px" src="/storage{{$data['shop_img']}}"></td>
                                    <td>{{$data['email']}}</td>
                                    <td>{{$data['created_at']}}</td>
                                    <td>{{$data['browsing_num']}}</td>
                                    <td>
                                        @if($data['status'] == 1)
                                            <span class="label bg-success">正常</span>
                                        @else
                                            <span class="label bg-success">停封</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($data['status']==1)
                                            <a hrefs="{{url('/admin/business/status')}}/{{$data['id']}}/2" class="btn btn-default btn-sm refuse"><i class="fa fa-fw fa-close"></i>停封</a>
                                            @else
                                            <a hrefs="{{url('/admin/business/status')}}/{{$data['id']}}/1" class="btn btn-default btn-sm delete"><i class="fa fa-fw fa-check"></i>解封</a>
                                        @endif
                                        <a href="{{url('/admin/activity/index')}}?select=shop_id&keyword={{$data['shop_id']}}" class="btn btn-default btn-sm"><i class="fa fa-fw fa-folder-open-o"></i>活动管理</a>
                                        <a href="{{url('/admin/business/edit')}}?id={{$data['id']}}" class="btn btn-default btn-sm"><i class="fa fa-fw fa-pencil"></i>修改</a>&nbsp;
                                        <a hrefs="{{url('/admin/business/delete')}}/{{$data['id']}}" class="btn btn-default btn-sm delete"><i class="fa fa-fw fa-trash"></i>删除</a>
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
            layer.prompt({
                formType: 2,
                title: '请输入拒绝的理由',
                offset: ['40%', '40%']
            }, function(value, index, elem){
                layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
                $.ajax({
                    url:url,
                    type:'get',
                    data:{remarks:value},
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