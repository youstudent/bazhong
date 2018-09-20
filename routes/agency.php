<?php
use Illuminate\Support\Facades\Route;

//商家后台
Route::group(['namespace' => 'Agency\Controller','middleware'=>'auth:business'],function (){
    //首页中心
    Route::match(['get','post'],'/index/index', 'IndexController@index');
    Route::post('/index/editPassword', 'IndexController@editPassword');
    //邮箱消息
    Route::get('/index/message','IndexController@message');
    //活动模块
    Route::group(['prefix'=>'activity'],function (){
         Route::get('/index','ActivityController@index');
         Route::match(['get','post'],'/create','ActivityController@create');
    });
});

Route::group(['namespace'=>'Agency'],function (){
    Auth::routes();
});