<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible"  name="csrf-token" content="{{ csrf_token() }}">
  <title> 巴中商贸| @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/css/laydate.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- 顶部菜单栏 开始 -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>Z</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>巴中</b>商贸</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">管理台</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  <small>
                    <button class="btn btn-info" data-toggle="modal" data-target="#myModal">
                      密码修改
                    </button>
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="text-center">
                  <a href="{{url('/admin/logout')}}" class="btn btn-default btn-flat">退出</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- 顶部菜单栏 结束-->
  <!-- 左侧(菜单) 头部开始-->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{request()->user()['name']}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- 菜单栏 开始 -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">管理中心</li>
        <li class="{{\Request::getRequestUri()=='/admin/index/index'?'active':''}}"><a href="{{url('admin/index/index')}}"><i class="fa fa-dashboard"></i>首页中心</a></li>
        <li class="treeview  {{explode('/',\Request::getRequestUri())[2]=='business'?'menu-open':''}}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>商家管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: {{explode('/',\Request::getRequestUri())[2]=='business'?'block':'none'}};">
            <li class="{{\Request::getRequestUri()=='/admin/business/index'?'active':''}}"><a  href="{{url('/admin/business/index')}}"><i class="fa fa-circle-o"></i>商家列表</a></li>
            <li class="{{\Request::getRequestUri()=='/admin/business/categoryList'?'active':''}}"><a  href="{{url('/admin/business/categoryList')}}"><i class="fa fa-circle-o"></i>分类列表</a></li>
          </ul>
        </li>
        <li class="treeview {{explode('/',\Request::getRequestUri())[2]=='activity'?'menu-open':''}}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>活动管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: {{explode('/',\Request::getRequestUri())[2]=='activity'?'block':'none'}};">
            <li class="{{\Request::getRequestUri()=='/admin/activity/index'?'active':''}}"><a href="{{url('admin/activity/index')}}"><i class="fa fa-circle-o"></i>活动列表</a></li>
          </ul>
        </li>

        <li class="treeview {{explode('/',\Request::getRequestUri())[2]=='banner'?'menu-open':''}}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>广告管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: {{explode('/',\Request::getRequestUri())[2]=='banner'?'block':'none'}};" >
            <li class="{{\Request::getRequestUri()=='/admin/banner/index'?'active':''}}"><a href="{{url('admin/banner/index')}}"><i class="fa fa-circle-o"></i>广告列表</a></li>
            <li class="{{\Request::getRequestUri()=='/admin/banner/record'?'active':''}}"><a href="{{url('admin/banner/record')}}"><i class="fa fa-circle-o"></i>报名统计</a></li>
          </ul>
        </li>
        <li class="treeview {{explode('/',\Request::getRequestUri())[2]=='email'?'menu-open':''}}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>邮件管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: {{explode('/',\Request::getRequestUri())[2]=='email'?'block':'none'}};">
            <li class="{{\Request::getRequestUri()=='/admin/email/index'?'active':''}}"><a href="{{url('admin/email/index')}}"><i class="fa fa-circle-o"></i> 邮件列表</a></li>
          </ul>
        </li>
        <li class="treeview {{explode('/',\Request::getRequestUri())[2]=='client_users'?'menu-open':''}}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>用户管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: {{explode('/',\Request::getRequestUri())[2]=='client_users'?'block':'none'}};">
            <li class="{{\Request::getRequestUri()=='/admin/client_users/index'?'active':''}}"><a href="{{url('admin/client_users/index')}}"><i class="fa fa-circle-o"></i>用户列表</a></li>
            <li class="{{\Request::getRequestUri()=='/admin/client_users/cardRecord'?'active':''}}"><a href="{{url('admin/client_users/cardRecord')}}"><i class="fa fa-circle-o"></i>打卡记录</a></li>
            <li class="{{\Request::getRequestUri()=='/admin/client_users/applyRecord'?'active':''}}"><a href="{{url('admin/client_users/applyRecord')}}"><i class="fa fa-circle-o"></i>经销商申请</a></li>
          </ul>
        </li>
        <li class="treeview {{explode('/',\Request::getRequestUri())[2]=='admin'?'menu-open':''}}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>权限管理</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: {{explode('/',\Request::getRequestUri())[2]=='admin'?'block':'none'}};">
            <li class="{{\Request::getRequestUri()=='/admin/admin/index'?'active':''}}"><a href="{{url('admin/admin/index')}}"><i class="fa fa-circle-o"></i>管理员列表</a></li>
            {{--<li><a href="{{url('admin/role/roleList')}}"><i class="fa fa-circle-o"></i>角色列表</a></li>--}}
            {{--<li><a href="{{url('admin/role/permissionList')}}"><i class="fa fa-circle-o"></i>路由列表</a></li>--}}
          </ul>
        </li>
      </ul>
      <!-- 菜单栏 结束-->
    </section>
  </aside>
  <!-- 左侧(菜单) 头部结束-->

  <!--内容部分  开始-->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!--内容部分  结束-->

  <!-- 底部开始 -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2018-2020</strong>
  </footer>
  <!-- 底部结束 -->

  <aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
      </div>
    </div>
  </aside>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>
<script src="/js/laydate.js"></script>
<script src="/js/layer.js"></script>
<script>
    //日期时间范围
    laydate.render({
        elem: '#time'
        ,type: 'datetime'
        ,range: true
        ,btns: ['confirm']
    });
    //平台用户充值
    $(".create").click(function () {
        var  form   = $("#payModalForm");
        var  action = form.attr('action');
        var  data   = form.serialize();
        $.ajax({
            url:action,
            type:'POST',
            data:data,
            success:function (res) {
                console.log(res);
                if(res.code == 1)
                {
                    window.location.href=res.url;
                }else{
                    location.reload();
                }
            },
        });
    });

    //平台用户充值
    $(".delete").click(function () {
        //询问框
        var url = $(this).attr("hrefs");

        layer.confirm('确认该操作？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            var index = layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
            $.ajax({
                url:url,
                type:'get',
                success:function (res) {
                    if(res.code == 1)
                    {
                        reload(res.message,1)
                    }else{
                        reload(res.message,5)
                    }
                }
            });

        }, function(){
        });
    });

    function reload($message,$icon) {
        layer.closeAll('loading');
        layer.msg($message, {icon: $icon});
        setTimeout(function(){
            location.reload();
        }, 600);
    };
    function reloadClear() {
        layer.closeAll('loading');
        setTimeout(function(){
            location.reload();
        }, 600);
    }
//<div id="" class="layui-layer-content"><textarea class="layui-layer-input"></textarea></div>
    //<div class="layui-layer-btn layui-layer-btn-"><a class="layui-layer-btn0">确定</a><a class="layui-layer-btn1">取消</a></div>
    //页面层

</script>
@yield('script')
@include('layouts.editPassword')
</body>
</html>
