<?php

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

Route::get('/', function () {
    return view('welcome');
});

///////////////////////////////////////////////////////////////////////////
// 用户模块
///////////////////////////////////////////////////////////////////////////

// 注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
// 注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');
// 登录登出
Route::get('/login', '\App\Http\Controllers\LoginController@index');
Route::post('/login', '\App\Http\Controllers\LoginController@login');
Route::get('/logout', '\App\Http\Controllers\LoginController@logout');
// 设置
Route::get('/user/me/setting', '\App\Http\Controllers\UserController@setting');
Route::post('/user/me/setting', '\App\Http\Controllers\UserController@settingStore');


///////////////////////////////////////////////////////////////////////////
// 搜索
///////////////////////////////////////////////////////////////////////////
/// 冲突的路由/posts/{post}  ("{post"是占位符) ,需要把跟精确的路由放在前面
Route::get('/posts/search', '\App\Http\Controllers\PostController@search');


///////////////////////////////////////////////////////////////////////////
// 文章模块
///////////////////////////////////////////////////////////////////////////

// 文章列表页
Route::get('/posts', '\App\Http\Controllers\PostController@index');

// 创建文章
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
Route::post('/posts', '\App\Http\Controllers\PostController@store');

// 文章详情页
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
// 编辑文章
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
//删除文档
Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');
// 评论
Route::post('/posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
// 赞
Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');
// 图片上传
Route::post('/posts/image/upload', '\App\Http\Controllers\PostController@imageUpload');

///////////////////////////////////////////////////////////////////////////
// 个人中心
///////////////////////////////////////////////////////////////////////////

// 个人中心页面
Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');

// 专题详情
Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');
Route::post('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');

