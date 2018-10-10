@extends('layouts.app')
@section('title')
    商家管理
@endsection
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            商家添加
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">商家添加</a></li>
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
                    <form class="form-horizontal" method="post" role="form"  action="{{url('/admin/business/create')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input  type="hidden" name="main_points_x" id="main_points_x">
                        <input type="hidden" name="main_points_y" id="main_points_y">
                        <div class="form-group">
                            <label for="suggestId" class="col-sm-2 control-label">店铺地址</label>
                            <div class="col-sm-7" id="r-result">
                                <input type="text" name="shop_position" id="suggestId" class="form-control"  placeholder="请输入店铺地址" required>
                                <div id="l-map" style="height: 500px;margin-top: 5px"></div>
                                <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-3">
                                <input type="email" required name="email" class="form-control" id="email" placeholder="请输入邮箱">
                            </div>
                            <label for="phone" class="col-sm-1 control-label">电话<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="phone" class="form-control" id="phone" pattern="(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$" placeholder="请输入电话" required >
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">销售分类</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="category_id">
                                    @foreach($category as $value)
                                        <option value="{{$value['id']}}">{{$value['category_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="lastnames" class="col-sm-1 control-label">销售类型</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="sales_type">
                                    @foreach(config('language.sales_type') as $key=> $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">店铺名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="请输入店铺名" required>
                            </div>
                            <label for="password" class="col-sm-1 control-label">密码<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="password" name="password"  required class="form-control text-danger" placeholder="请输输入密码">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="intro" class="col-sm-2 control-label">简介</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" maxlength="100" id="intro" rows="3" placeholder="限定字数100"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">logo图片<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="shop_img" class="file" type="file" accept="image/*" required>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">广告图片</label>
                            <div class="col-sm-7">
                                <input id="file-2" name="files[]" type="file" multiple class="file"  data-upload-url="#" data-min-file-count="10" accept="image/*">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">添加</button>
                            </div>
                        </div>
                        <p class="page-header"></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6o2Gs6C905ObYPVcdzbiXFOAh3xwKfLB"></script>
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.js" type="text/javascript"></script>
    <script src="/js/fileinput_locale_de.js" type="text/javascript"></script>
    <script>
       var a = "{{$errors->first()}}";
       if (a){
           layer.msg(a+'!!', {icon: 5})
       }
       var url1 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg';
       $("#file-2").fileinput({
           uploadUrl: '#', // you must set a valid URL here else you will get an error
           allowedFileExtensions : ['jpg', 'png','gif'],
           language: 'zh',
           showPreview: true,
           overwriteInitial: false,
           maxFileSize: 1000,
           initialPreviewAsData: true,
           maxFilesNum: 10,
           showUpload:false,
           initialPreviewConfig: [
               {caption: "Moon.jpg", downloadUrl: url1, size: 930321, width: "120px", key: 1}
           ],
               slugCallback: function(filename) {
               return filename.replace('(', '_').replace(']', '_');
           }
       });
    </script>
    <script type="text/javascript">
        // 百度地图API功能
        function G(id) {
            return document.getElementById(id);
        }

        var map = new BMap.Map("l-map");
        map.centerAndZoom("巴中市",12);                   // 初始化地图,设置城市和地图级别。

        var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
            {"input" : "suggestId"
                ,"location" : map
            });

        ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
            var str = "";
            var _value = e.fromitem.value;
            var value = "";
            if (e.fromitem.index > -1) {
                value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            }
            str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

            value = "";
            if (e.toitem.index > -1) {
                _value = e.toitem.value;
                value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            }
            str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
            G("searchResultPanel").innerHTML = str;
        });

        var myValue;
        ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
            var _value = e.item.value;
            myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;

            setPlace();
        });

        function setPlace(){
            map.clearOverlays();    //清除地图上所有覆盖物
            function myFun(){
                var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
                map.centerAndZoom(pp, 18);
                map.addOverlay(new BMap.Marker(pp));    //添加标注
                $("#main_points_x").val(pp.lng);
                $("#main_points_y").val(pp.lat);
            }
            var local = new BMap.LocalSearch(map, { //智能搜索
                onSearchComplete: myFun
            });
            local.search(myValue);
        }
    </script>


@endsection
