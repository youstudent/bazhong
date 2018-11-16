@extends('layouts.app')
@section('title')
    参数配置
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            参数配置
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">参数配置</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <div class="col-sm-4">
                            <form action="{{url('/admin/business/createAreaName')}}/1" method="post">
                                @csrf
                                <div class="input-group col-lg-push-6 col-sm-6">
                                    <input name="area" type="text" class="form-control" placeholder="区域名" required>
                                    <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i>添加</button>
                                    </span>
                                </div>
                            </form>

                            <table class="table table-hover table-bordered text-center table-striped">
                              <tr>
                                  <th style="width: 50%">经营区域</th>
                                  <th>操作</th>
                              </tr>
                              @foreach($areas as $value)
                                <tr>
                                    <td>{{$value['area']}}</td>
                                    <td>
                                        @if($value['area']!=='其它')
                                            <a hrefs="{{url('/admin/business/editOption')}}/{{$value['id']}}" value="{{$value['area']}}" type="1"  class="btn btn-default btn-sm option"><i class="fa fa-fw fa-pencil"></i>修改</a>&nbsp;
                                            <a hrefs="{{url('/admin/business/areaDelete')}}/{{$value['id']}}" class="btn btn-default btn-sm delete"><i class="fa fa-fw fa-trash"></i>删除</a>
                                        @endif

                                    </td>
                                </tr>
                              @endforeach
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <form action="{{url('/admin/business/createAreaName')}}/2" method="post">
                                @csrf
                                <div class="input-group col-lg-push-6 col-sm-6">
                                    <input name="name" type="text" class="form-control" placeholder="经营类型" required>
                                    <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i>添加</button>
                                    </span>
                                </div>
                            </form>
                            <table class="table table-hover table-bordered text-center table-striped">
                                <tr>
                                    <th style="width: 50%">经营类型</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($names as $value)
                                    <tr>
                                        <td>{{$value['name']}}</td>
                                        <td>
                                            @if($value['name']!=='其它')
                                                <a hrefs="{{url('/admin/business/editOption')}}/{{$value['id']}}" value="{{$value['name']}}" type="2"  class="btn btn-default btn-sm option"><i class="fa fa-fw fa-pencil"></i>修改</a>&nbsp;
                                                <a hrefs="{{url('/admin/business/nameDelete')}}/{{$value['id']}}" class="btn btn-default btn-sm delete"><i class="fa fa-fw fa-trash"></i>删除</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-sm-4">
                            <form action="{{url('/admin/business/createAreaName')}}/3" method="post">
                                @csrf
                                <div class="input-group col-lg-push-6 col-sm-6">
                                    <input name="name" type="text" class="form-control" placeholder="热门搜索" required>
                                    <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-plus"></i>添加</button>
                                    </span>
                                </div>
                            </form>
                            <table class="table table-hover table-bordered text-center table-striped">
                                <tr>
                                    <th style="width: 50%">热门搜索</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($HotSearch as $value)
                                    <tr>
                                        <td>{{$value['name']}}</td>
                                        <td>
                                            @if($value['name']!=='其它')
                                                <a hrefs="{{url('/admin/business/editOption')}}/{{$value['id']}}" value="{{$value['name']}}" type="3"  class="btn btn-default btn-sm option"><i class="fa fa-fw fa-pencil"></i>修改</a>&nbsp;
                                                <a hrefs="{{url('/admin/business/hotDelete')}}/{{$value['id']}}" class="btn btn-default btn-sm delete"><i class="fa fa-fw fa-trash"></i>删除</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <!-- /.box -->
            </div>

        </div>
    </section>

@endsection
@section('script')
    <script>
        $('.option').click(function () {
          var url = $(this).attr("hrefs");
          var value = $(this).attr("value");
          var type = $(this).attr("type");
          var csrf = "{{csrf_token()}}";
            layer.prompt({title: '编辑', formType: 3, 'value':value}, function(pass, index){
                layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
                $.ajax({
                    url:url,
                    type:'post',
                    data:{value:pass,'type':type,'_token':csrf},
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