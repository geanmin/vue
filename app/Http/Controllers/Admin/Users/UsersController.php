<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use App\Validate\UserValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use App\Http\Controllers\ResponseController as Response;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->validate = new UserValidate();
    }

    /**
     * 后台管理员管理
     */
    public function index(Request $request)
    {
        try {

        } catch (Exception $e) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }

    /**
     * 添加管理员
     */
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('get')) {

            } else {
                if ($err = $this->validate->check($request->all(), 'add')) {
                    return Response::PcResponse(40000, $err, '', 200);
                }
                $param = $request->all();
                DB::beginTransaction();
                $user = User::create([
                    'name' => $param['name'],
                    'password' => Hash::make($param['password']),
                    'email' => isset($param['email']) ? $param['email'] : 0
                ]);
                $roleName = Roles::where('id', $param['role_id'])->value('name');
                $roles = $user->assignRole($roleName);
                if ($user && $roles) {
                    DB::commit();
                } else {
                    DB::rollBack();
                }
                return Response::PcResponse(0, '添加成功', '', 200);
            }
        } catch (Exception $e) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }

    //编辑权限
    public function edit(Request $request)
    {
        try {
            if ($request->isMethod('get')) {
                return Response::PcResponse(0, '修改成功', '', 200);
            } else {
                return Response::PcResponse(0, '修改成功', '', 200);
            }
        } catch (Exception $e) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }
}
