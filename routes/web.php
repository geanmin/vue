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

Route::group(['namespace' => 'Admin\Users', 'prefix' => 'v1/admin'], function () {
    //权限添加
    Route::post('permissions/add', 'PermissionsController@add');
    //权限首页
    Route::get('permissions/index', 'PermissionsController@index');
    //修改权限
    Route::post('permissions/edit', 'PermissionsController@edit');
    //添加角色
    Route::post('roles/add', 'RolesController@add');
    //修改权限
    Route::post('roles/edit', 'RolesController@edit');
    //添加用户
    Route::post('users/add', 'UsersController@add');
    //修改用户
    Route::get('users/edit', 'UsersController@edit');
    Route::post('users/edit', 'UsersController@edit');
});

