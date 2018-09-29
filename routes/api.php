<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');



// 配置api版本和路由   进行授权认证的接口
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1\Controller','middleware' => 'api.auth'], function ($api) {
    //个人信息
    $api->group(['prefix'=>'users'], function($api){
        $api->match(['get','post'],"/index", 'ClientUsersController@index'); //个人中心
        $api->get("/setCollection", 'ClientUsersController@setCollection'); //收藏商家
        $api->get("/getCollection", 'ClientUsersController@getCollection'); //获取商家
        $api->get("/deleteCollection", 'ClientUsersController@deleteCollection'); //删除商家
        $api->match(['get','post'],"/ptc", 'ClientUsersController@ptc'); //打卡和打卡记录
        $api->post('/uploadHeadimgurl','ClientUsersController@uploadHeadimgurl');
    });
    $api->group(['prefix'=>'application'],function ($api){
        $api->match(['get','post'],"/apply", 'ApplicationController@apply');//申请资料
        $api->post("/applyBusinessImg",'ApplicationController@applyBusinessImg');//图片上传
    });

});
// 不进行授权认证的接口
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1\Controller'], function ($api) {
    //登陆
    $api->post("login", 'LoginController@login');

    //消息模块
    $api->group(['prefix'=>'message'], function($api){
        $api->post("/sendMsg", 'MessageController@sendMsg');
        $api->post("/check", 'MessageController@check');
        $api->get("/sendTest", 'MessageController@sendTest');
    });
    //商家模块
    $api->group(['prefix'=>'business'], function($api){
        $api->get("/index", 'BusinessController@index');
        $api->get("/getCategory",'BusinessController@getCategory');
        $api->get("/activityList",'BusinessController@activityList');
        $api->get('/hostSearch','BusinessController@hotSearch'); // 热门搜索
        $api->get('/getCategoryList','BusinessController@getCategoryList'); // 商家分类
        $api->get('/activityDetail','BusinessController@activityDetail'); // 活动详情
        $api->get('/getDetails','BusinessController@getDetails')->middleware('api.auth'); //该路由单独使用中间件
    });
    //广告
    $api->group(['prefix'=>'banner'], function($api){
        $api->get("/index", 'BannerController@index');
        $api->post("/signUp", 'BannerController@signUp');
        $api->post("/detail", 'BannerController@detail');
        $api->get("/homeImg", 'BannerController@homeImg'); //形象页面图片
    });
});