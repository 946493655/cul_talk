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
    Route::get('/', 'HomeController@index');
    //具体列表
    Route::get('free', 'HomeController@getFree');
    Route::get('graph', 'HomeController@getGraph');
    Route::get('video', 'HomeController@getVideo');
    Route::get('design', 'HomeController@getDesign');
    Route::get('track', 'HomeController@getTrack');
    Route::get('t/{topic_id}', 'HomeController@show');
    //话题路由
    Route::get('topic/talk', 'TalkController@getTopic');
    Route::group(['prefix'=>'t/{topic_id}'], function(){
        Route::resource('talk', 'TalkController');
    });
});