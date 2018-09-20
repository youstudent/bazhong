<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家后台</title>
<link rel="stylesheet" type="text/css" href="/css/agencystyle.css" />
<link rel="stylesheet" type="text/css" href="/css/agencybody.css"/>
</head>
<body>
<div class="container">
	<section id="content">
		<form action="{{url('/agency/login')}}" method="post">
			@csrf
			<h1>商家登陆</h1>
			<div>
				<input type="text" name="phone" placeholder="手机号码" required id="phone"/>
			</div>
			<div>
				<input type="password" name="password" placeholder="密码" required  id="password" />
			</div>
			<label style="font-size: 15px;float: left;margin-left: 10px">
				<input type="checkbox" name="remember"> 记住我
			</label>
			 <div style="height: 20px">
				<span style="color: red">{{$errors->first()?'账号或密码错误!':''}}</span></div>
			<div>
				<!-- <input type="submit" value="Log in" /> -->
				<input type="submit" value="登录" class="btn btn-primary" id="js-btn-login"/>
				<!-- <a href="#">Register</a> -->
			</div>

		</form><!-- form -->
	</section><!-- content -->
</div>
</body>
</html>