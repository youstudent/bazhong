@extends('layouts.app')
@section('title')
    邮件管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            邮件添加
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">邮件添加</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Example</h3>
                    </div>
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('admin/email/create')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">标题<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input type="text" name="title" class="form-control" id="title" placeholder="请输入标题" required>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">发送销售分类</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="category_id" id="select">
                                    <option value="0">群发消息</option>
                                    @foreach($category as $value)
                                        <option value="{{$value['id']}}">{{$value['category_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="lastnames" class="col-sm-1 control-label">发送商家</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="business_id" id="business_id">
                                    <option value="0">群发消息</option>
                                </select>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="content" class="col-sm-2 control-label">内容<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <textarea class="form-control" rows="3" id="content" name="content" required></textarea>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"><i class="fa fa-envelope"></i> 发送</button>
                            </div>
                        </div>
                        <p class="page-header"></p>
                    </form>
                </div>
            </div>
        </div>
        <div class="container kv-main">

        </div>
    </section>
@endsection
@section('script')
    <script>
        var select = document.getElementById('select');
        select.onchange = function(){
            var obj=document.getElementById('business_id');
            obj.options.length=0;
            $('#business_id').append('<option value="0">群发消息</option>');
            $.ajax({
                    url:'/admin/email/sonCategory',
                    type:'get',
                    data:{'id':$(this).val()},
                    success:function (res) {
                        if(res.code == 1)
                        {
                            res.data.forEach(function (value,index) {
                                var a = '<option value='+value.id+'>'+value.name+'</option>';
                                $('#business_id').append(a);
                            })
                        }else{
                            reload(res.message,5)
                        }
                    }
                });

        }


    </script>

@endsection
