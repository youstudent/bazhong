@extends('agency.layouts.app')
@section('title')
    消息列表
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            消息列表
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">消息列表</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header" style="margin-top: 10px">
                        <form id="lr_form" action="{{url('agency/index/message')}}" method="get">
                            <div class="form-inline">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" id="time" name="time" class="form-control" style="width: 268px" value="{{$time}}"  readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <div class="form-group field-users-select">
                                        <select id="users-select" class="form-control" name="select">
                                            <option value="1">智能查询</option>
                                            <option {{request('select')=='theme'?'selected':''}} value="theme">主题</option>
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
                                        <a class="btn btn-default" href="{{'/agency/index/message'}}">重置</a>
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
                                <th>主题</th>
                                <th>内容</th>
                                <th>发送时间</th>
                            </tr>
                            <?php $i=1?>
                            @foreach($datas as $data)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data['title']}}</td>
                                    <td>{{$data['content']}}</td>
                                    <td>{{$data['created_at']}}</td>
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
<?php $a =2?>
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
        //详情
        $(".details").click(function () {
            layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
            var url = $(this).attr("hrefs");
            $.ajax({
                url:url,
                type:'get',
                success:function (res) {
                    layer.closeAll('loading');
                    var a = res.data.theme;
                    if(res.code==1){
                        layer.open({
                            type: 1,
                            skin: 'layui-layer-rim', //加上边框
                            area: ['800px', '500px'], //宽高
                            content: '<table class="table table-hover table-bordered text-center table-striped">' +
                            "<tr><td>主题</td><td>吃东西</td></tr>" +
                            "<tr><td>地址</td><td>成都市</td></tr>" +
                            "<tr><td>图片</td><td>图片</td></tr>" +
                            '</table>'
                        });
                    }else {
                        reload(res.message,5)
                    }
                }
            });


        });
    </script>
@endsection