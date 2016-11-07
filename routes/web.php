<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', 'Admin\HomeController@index');

Route::group(['namespace' => 'Portal'], function () {
    Route::get('skin/{skin_id}', 'SkinController@show');
    Route::post('skin/{skin_id}', 'SkinController@download');
});
Route::group(['prefix' => 'auth'], function () {
    Route::auth();
});
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'level:2|auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::resource('skin', 'SkinController');
    Route::group(['middleware' => 'role:admin'], function () {
        Route::resource('user', 'UserController');
        Route::resource('role', 'RoleController');
        Route::resource('role.permission', 'PermissionController', ['only' => ['index', 'store']]);
    });
});