<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Validate\RolesValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use App\Http\Controllers\ResponseController as Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->validate = new  RolesValidate();
    }

    /**
     * 后台管理员权限列表
     */
    public function index(Request $request, $id = null)
    {
        try {
            $name = Roles::where('id', $id)->value('name');
            $role = Role::findByName($name);
            //获取角色的所有权限

            return view('admin.roles.index');
        } catch (Exception $e) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }

    /**
     * 添加权限
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
                $role = Role::create(['name' => $param['name']]);
                $role->givePermissionTo($param['rules']);
                return Response::PcResponse(0, '添加成功', '', 200);
            }
        } catch (Exception $e) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }

    /**
     * 修改权限
     */
    public function edit(Request $request)
    {
        try {
            if ($request->isMethod('get')) {

            } else {
                if ($err = $this->validate->check($request->all(), 'edit')) {
                    return Response::PcResponse(40000, $err, '', 200);
                }
                $param = $request->all();
                $roles = Roles::find($param['id']);
                $oldRules = Roles::getPermissionsByRolesId($param['id']);
//                var_dump($oldRules);exit();
                DB::beginTransaction();
                $role = Role::findByName($roles->name);
                $role->syncPermissions($oldRules);
                $old_role_id = $role->revokePermissionTo($oldRules);
                $role_id = $role->givePermissionTo($param['rules']);
                //改变角色名称
                $uid = Roles::where('id', $param['id'])->update(['name' => $param['name']]);
                if ($old_role_id && $role_id && $uid) {
                    DB::commit();
                } else {
                    DB::rollBack();
                }
                return Response::PcResponse(0, '修改成功', '', 200);
            }
        } catch (Exception $e) {
            return Response::PcResponse(0, '服务器错误', '', 520);
        }
    }
}
