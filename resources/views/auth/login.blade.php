<!DOCTYPE html>
<!-- saved from url=(0047)http://yanshi.sucaihuo.com/modals/37/3757/demo/ -->
<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit">
    <title>登录</title>
	
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="/css/style.css">

</head>
<body style="">
    <div class="bg"></div>
    <div class="container">
        <div class="line bouncein">
            <div class="xs6 xm4 xs3-move xm4-move">
                <div style="height:150px;"></div>
                <div class="media media-y margin-big-bottom">
                </div>
                <form action="{{url('admin/login')}}" method="post">
                    @csrf
                    <div class="panel loginbox">
                        <div class="text-center margin-big padding-big-top">
                            <h1>后台管理中心</h1>
                            <div style="color:red;">
                                {{$errors->first()?$errors->first():''}}
                            </div>
                        </div>
                        <div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
                            <div class="form-group has-warning">
                                <div class="field field-icon-right">
                                    <input type="text" class="input input-big" name="name" id="username" placeholder="登录账号" required>
                                    <span class="icon icon-user margin-small"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="field field-icon-right">
                                    <input type="password" class="input input-big" name="password" id="password" placeholder="登录密码" required>
                                    <span class="icon icon-key margin-small"></span>
                                </div>
                            </div>
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label style="font-size: 15px">
                                        <input type="checkbox" name="remember"> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div style="padding:30px;">
                            <input type="submit" id="button" class="button button-block bg-main text-big input-big" value="登录">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>