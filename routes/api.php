<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['namespace' => 'Index\Login', 'prefix' => 'v1/auth'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('refresh', 'LoginController@refresh');
    Route::post('logout', 'LoginController@logout');
    Route::post('me', 'LoginController@me');
});
Route::group(['namespace' => 'Index\Login', 'prefix' => 'v1/auth', 'middleware' => 'refresh'], function () {
    Route::post('getUser', 'LoginController@getUser');
});

//获取用户权限
Route::group(['namespace' => 'Index\Roles', 'prefix' => 'v1/auth', 'middleware' => 'refresh'], function () {
    Route::post('getUsersRolesList', 'RolesController@getUsersRolesList');
});
