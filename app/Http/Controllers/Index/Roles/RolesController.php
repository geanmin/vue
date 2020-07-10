<?php

namespace App\Http\Controllers\Index\Roles;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index\Common\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Http\Controllers\ResponseController as Response;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tymon\JWTAuth\Facades\JWTAuth;

class RolesController extends AuthController
{
    public function __construct()
    {
        //167 128
        //172 130
    }

    /**
     * 获取登录用户者权限列表
     */
    public function getUsersRolesList()
    {
        try {
            $user = auth('api')->user();
//            var_dump($user);exit();
            $user = User::where('id',$user->id)->first();
//            var_dump($user);exit();
            $permissions = $user->getAllPermissions();
            return Response::PcResponse(0, '查询成功', $permissions, 200);
        } catch (Exception $e) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }
}
