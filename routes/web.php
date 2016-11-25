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
    return view('portal.index');
});

Route::group(['prefix' => 'upload'], function () {
    Route::get('/', ['uses' => 'Admin\SkinController@test', 'middleware' => 'auth']);
    Route::get('token', ['uses' => 'Admin\SkinController@token', 'middleware' => 'auth']);
    Route::post('callback', 'Admin\SkinController@callback');
});

Route::group(['namespace' => 'Portal'], function () {
    Route::get('skin', 'SkinController@index');
    Route::get('skin/{skin_id}', 'SkinController@show');
    Route::post('skin/{skin_id}', 'SkinController@download');
});

Route::group(['prefix' => 'auth'], function () {
    Route::auth();
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'level:2|auth'], function () {
    Route::get('/', 'HomeController@index');
    
    Route::get('my', 'MyController@edit');
    Route::get('my/logout', 'MyController@logout');
    Route::put('my', 'MyController@update');

    Route::resource('skin', 'SkinController', ['except' => ['store', 'destory']]);
    
    Route::group(['middleware' => 'role:admin'], function () {
        Route::resource('user', 'UserController');
        Route::resource('role', 'RoleController');
        Route::resource('role.permission', 'PermissionController', ['only' => ['index', 'store']]);
    });
});