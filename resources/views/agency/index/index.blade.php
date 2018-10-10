@extends('agency.layouts.app')

@section('title')
    商家首页
@endsection()

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            商家首页
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>商家首页</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a style="color:#000;" href="{{url('/agency/index/message')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">消息</span>
                        <span class="info-box-number">{{$emailCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a style="color:#000;" href="{{url('/agency/activity/index')}}">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">活动数量</span>
                        <span class="info-box-number">{{$activityCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a style="color:#000;" href="{{url('/agency/activity/index')}}?status=4">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">上线活动</span>
                        <span class="info-box-number">{{$activityIngCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <a style="color:#000;" href="{{url('/agency/activity/index')}}?status=3">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">拒绝活动</span>
                        <span class="info-box-number">{{$activityRefuseCount}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">店铺信息</h3>
                    </div>
                    <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/agency/index/index')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <input  type="hidden" name="main_points_x" id="main_points_x">
                        <input type="hidden" name="main_points_y" id="main_points_y">
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">当前店铺地址</label>
                            <div class="col-sm-7">
                                <input type="text"  id="shop_position"  class="form-control"  required value="{{$data['shop_position']}}" readonly="readonly">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="suggestId" class="col-sm-2 control-label">新店铺地址</label>
                            <div class="col-sm-7" id="r-result">
                                <input type="text" name="shop_position" id="suggestId" class="form-control"  placeholder="如需修改店铺地址:请输入店铺地址">
                                <div id="l-map" style="height: 500px;margin-top: 5px"></div>
                                <div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="intro" class="col-sm-2 control-label">简介<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <textarea name="intro" class="form-control" id="intro" rows="3" placeholder="活动内容.限定字数100" maxlength="100" required>{{$data['intro']}}</textarea>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="file-1" class="col-sm-2 control-label">logo图片<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="shop_img" class="file" type="file" accept="image/*">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-info">修改</button>
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
        //logo图片
        const shop = '/storage'+"{{$data['shop_img']}}";
        $("#file-1").fileinput({
            layoutTemplates :{
                actionUpload:'',//去除上传预览缩略图中的上传图片
                actionZoom:''  //去除上传预览缩略图中的查看详情预览的缩略图标。
            },
            showUpload:false,
            initialPreview: [ //预览图片的设置
                "<img  src='" + shop + "' class='file-preview-image' alt='肖像图片' title='肖像图片'>",
            ]
        });
    </script>
    <script type="text/javascript">
        // 百度地图API功能
        function G(id) {
            return document.getElementById(id);
        }
        var map = new BMap.Map("l-map");
        map.centerAndZoom("{{$data['shop_position']}}",50);

        map.mc.lng="{{$data['main_points_x']}}";
        map.mc.lat="{{$data['main_points_y']}}";
        // 初始化地图,设置城市和地图级别。
        map.addOverlay(new BMap.Marker({lng:map.mc.lng,lat:map.mc.lat}));
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
                console.log(pp);
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