<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});


/**
 * 前台页面
 */
Route::group(['prefix'=>'login'], function(){
    Route::get('/', 'LoginController@index');
    Route::post('dologin', 'LoginController@dologin');
    Route::get('logout', 'LoginController@logout');
});


/**
 * 前台页面
 */
Route::group(['prefix'=>'/','namespace'=>'Home'], function(){
    //首页、几个列表路由
    Route::get('/', 'HomeController@index');
    Route::get('s/{topic}', 'HomeController@show');         //s是代表检索
    Route::get('s/{topic}/{cate}', 'HomeController@show');
    Route::resource('topic', 'TopicController');
    //类别路由
    Route::group(['prefix'=>'s/{topic_id}'], function(){
        Route::post('cate/getcates', 'CateController@getCatesByTopic');
        Route::resource('cate', 'CateController');
    });
    //话题路由
    Route::get('talk/topic', 'TalkController@getTopic');
    Route::group(['prefix'=>'t/{topic_id}'], function(){
        Route::resource('talk', 'TalkController');
    });
});


/**
 * 会员页面
 */
Route::group(['prefix'=>'/','middleware' =>'MemberAuth','namespace'=>'Home'], function(){
    //用户信息
    Route::get('account', 'UserController@index');
});