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
    Route::get('s/{topic}/{cate}/talk', 'HomeController@show');
    Route::resource('topic', 'TopicController');
    //类别路由
    Route::group(['prefix'=>'s/{topic_id}'], function(){
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
Route::group(['prefix'=>'member','middleware' =>'MemberAuth','namespace'=>'Member'], function(){
    //用户信息
    Route::get('/', 'UserController@index');
    //专栏路由
    Route::resource('topic', 'TopicController');
    //类别路由
    Route::resource('cate', 'CateController');
    //类别路由
    Route::resource('talk', 'TalkController');
    //评论路由
    Route::resource('comment', 'CommentController');
    //奖励记录路由
    Route::resource('award', 'AwardController');
    //积分路由
    Route::resource('integral', 'IntegralController');
    Route::resource('integral/s/{genre}', 'IntegralController@index');      //s代表检索
    //回复路由
    Route::get('reply/add', 'ReplyController@addReply');
    Route::get('t/{talkid}/reply', 'ReplyController@index');
    Route::get('reply/getuser/{talkid}/{uid}', 'ReplyController@getUser');
    Route::resource('reply', 'ReplyController');
});