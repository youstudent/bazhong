@extends('layouts.app')
@section('title')
    商家管理
@endsection
<?php $img?>
@section('content')
    <!-- Main content -->
    <section class="content-header">
        <h1>
            商家更新
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i>首页</a></li>
            <li><a href="#">商家更新</a></li>
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
                    <form class="form-horizontal" method="post" role="form" id="payModalForm" action="{{url('/admin/business/edit')}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" value="{{$data['id']}}">
                        <input  type="hidden" name="main_points_x" id="main_points_x">
                        <input type="hidden" name="main_points_y" id="main_points_y">
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">店铺地址详细</label>
                            <div class="col-sm-7">
                                <input type="text"  id="shop_position" placeholder="请输入:店铺地址详细"  class="form-control"  required value="{{$data['shop_position']}}">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label class="col-sm-2 control-label">经纬度</label>
                            <div class="col-sm-7">
                                <input type="text" value="{{$data['main_points_x']}},{{$data['main_points_y']}}" id="position" class="form-control"  placeholder="点击地图获取获取" readonly="readonly" required >
                                <div id="allmap" style="height: 500px;margin-top: 5px"></div>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">邮箱</label>
                            <div class="col-sm-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="请输入邮箱" value="{{$data['email']}}">
                            </div>
                            <label for="phone" class="col-sm-1 control-label">电话<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="phone" class="form-control" id="phone" pattern="(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$" placeholder="请输入电话" required value="{{$data['phone']}}" >
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label class="col-sm-2 control-label">关键字A</label>
                            <div class="col-sm-1">
                                <input type="text" required name="Keyword_one" class="form-control" value="{{$data['Keyword_one']}}" >
                            </div>
                            <label class="col-sm-1 control-label">关键字B</label>
                            <div class="col-sm-1">
                                <input type="text" required name="Keyword_two" class="form-control" value="{{$data['Keyword_two']}}" >
                            </div>
                            <label class="col-sm-1 control-label">关键字C</label>
                            <div class="col-sm-1">
                                <input type="text" required name="Keyword_three" class="form-control" value="{{$data['Keyword_three']}}" >
                            </div>
                            <label  class="col-sm-1 control-label">关键字D</label>
                            <div class="col-sm-1">
                                <input type="text" required name="Keyword_four" class="form-control" value="{{$data['Keyword_four']}}">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">销售分类</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="son_category_id">
                                    @foreach($category as $key=>$value)
                                        <option {{in_array($key,$pent_data)?'disabled':''}} {{$data['son_category_id']==$key? 'selected':''}} value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="lastnames" class="col-sm-1 control-label">销售类型</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="sales_type">
                                    @foreach(config('language.sales_type') as $key=> $value)
                                        <option {{$data['sales_type']==$key?'selected':''}} value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">店铺名<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="请输入店铺名" required value="{{$data['name']}}">
                            </div>
                            <label for="name" class="col-sm-1 control-label">商家有效截止期<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-3">
                                <input type="text" name="effective_date" class="form-control" id="effective_date" placeholder="请店家选择日期" required value="{{$data['effective_date']}}">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="intro" class="col-sm-2 control-label">简介</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" maxlength="100" name="intro" id="intro" rows="3" placeholder="限定字数100">{{$data['intro']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">logo图片<span style="color: red">&nbsp;*</span></label>
                            <div class="col-sm-7">
                                <input id="file-1" name="shop_img" class="file" type="file" accept="image/*">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <label for="shop_position" class="col-sm-2 control-label">广告图片</label>
                            <div class="col-sm-7">
                                <input id="file-2" name="files[]" type="file" multiple class="file" accept="image/*"  data-upload-url="#" data-min-file-count="10">
                            </div>
                        </div>
                        <hr style="height:1px;border:none;border-top:1px dashed lavender;" />
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"><i class="fa fa-fw fa-pencil"></i>修改</button>
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
    <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=6o2Gs6C905ObYPVcdzbiXFOAh3xwKfLB"></script>
    <link href="/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
    <script src="/js/fileinput.js" type="text/javascript"></script>
    <script src="/js/fileinput_locale_de.js" type="text/javascript"></script>
    <script>
       var a = "{{$errors->first()}}";
       if (a){
           layer.msg(a+'!!', {icon: 5})
       }
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
       $("#file-2").fileinput({
           language: 'zh',
           uploadUrl: '#', // you must set a valid URL here else you will get an error
           allowedFileExtensions : ['jpg', 'png','gif','jpeg'],
           showPreview: true,
           overwriteInitial: false,
           maxFileSize: 1000,
           initialPreviewAsData: true,
           maxFilesNum: 10,
           showUpload:false,
           layoutTemplates :{
               actionUpload:'',//去除上传预览缩略图中的上传图片
               actionZoom:''   //去除上传预览缩略图中的查看详情预览的缩略图标。
           },
           initialPreview: [ //预览图片的设置
               <?php foreach ($img as $value){
               echo "\""."<img src='/storage/{$value['img']}' class='file-preview-image' alt='肖像图片' title='肖像图片'>"."\"".",";
               }
           ?>
           ],
           initialPreviewConfig: [ //配置预览中的一些参数
               <?php foreach ($img as $value){
                  echo "{caption: 'transport-1.jpg', size: 329892, width: '120px', url: '/admin/business/del', key: {$value['id']}}".",";
               }
               ?>

           ],
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
        map.addOverlay(new BMap.Marker({lng:map.mc.lng,lat:map.mc.lat}));
        // 初始化地图,设置城市和地图级别。

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

    <script type="text/javascript">
        var x ='<?php echo $data['main_points_x']?>';
        var y ='<?php echo $data['main_points_y']?>';
        // 百度地图API功能
        var map = new BMap.Map("allmap");
        map.centerAndZoom(new BMap.Point(x,y),100);
        map.enableScrollWheelZoom();   //启用滚轮放大缩小，默认禁用
        map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
        //单击获取点击的经纬度
        map.addEventListener("click",function(e){
            $("#main_points_x").val(e.point.lng);
            $("#main_points_y").val(e.point.lat);
            $("#position").val(e.point.lng + "," + e.point.lat);
        });
        //日期时间范围
        laydate.render({
            elem: '#effective_date'
        });
    </script>
@endsection
