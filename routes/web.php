<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>'auth:web','namespace'=>'Admin'], function(){
    //首页
    Route::get('/index/index','IndexController@index');

    //商家管理
    Route::group(['prefix'=>'business'], function(){
        Route::get('/index','BusinessController@index');
        Route::get('/delete/{id}','BusinessController@delete');
        Route::match(['get','post'],'/create','BusinessController@create');
        Route::match(['get','post'],'/edit','BusinessController@edit');
        Route::delete('/del','BusinessController@del');
        Route::get('/categoryList','BusinessController@categoryList');
        Route::match(['get','post'],'/categoryEdit','BusinessController@categoryEdit');
        Route::get('/status/{id}/{status}','BusinessController@status');
    });

//广告位管理
    Route::group(['prefix'=>'banner'],function (){
        Route::get('/index','BannerController@index');
        Route::get('/record','BannerController@record');
        Route::match(['get','post'],'/edit','BannerController@edit');
    });
//活动管理
    Route::group(['prefix'=>'activity'],function (){
        Route::get('/index','ActivityController@index');
        Route::get('/status/{id}','ActivityController@status');
        Route::get('/details/{id}','ActivityController@details');
    });
//邮件管理
    Route::group(['prefix'=>'email'],function (){
        Route::get('/index','EmailController@index');
        Route::match(['get','post'],'/create','EmailController@create');

    });

//玩家管理
    Route::group(['prefix'=>'client_users'],function (){
        Route::get('/index','ClientUsersController@index');
        Route::match(['get','post'],'/edit','ClientUsersController@edit');
        Route::get('/cardRecord','ClientUsersController@cardRecord');
        Route::get('/applyRecord','ClientUsersController@applyRecord'); //打卡记录
        Route::get('/status/{id}/{status}','ClientUsersController@status');
    });
    //管理员
    Route::group(['prefix'=>'admin'],function (){
        Route::get('/index','AdminController@index');
        Route::post('/editPassword','AdminController@editPassword');
        Route::match(['get','post'],'/create','AdminController@create');
        Route::match(['get','post'],'/edit','AdminController@edit');
        Route::get('/delete/{id}','AdminController@delete');
    });


    // Rbac
    Route::group(['prefix'=>'role'],function (){
         Route::get('/roleList','RbacController@roleList');
         Route::get('/permissionList','RbacController@permissionList');
         Route::get('/permissionAdd','RbacController@permissionAdd');
         Route::get('/permissionDelete/{id}','RbacController@permissionDelete');
    });

});

Route::auth();
Route::group(['namespace'=>'Admin'],function (){
    Auth::routes();
});

//Route::get('/home', 'HomeController@index');



//Route::get('/home', 'HomeController@index')->name('home');