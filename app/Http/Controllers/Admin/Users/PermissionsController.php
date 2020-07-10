<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Http\Controllers\ResponseController as Response;
use Spatie\Permission\Models\Permission;
use App\Validate\PermissionsValidate;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->validate = new PermissionsValidate();
    }

    //权限添加
    public function add(Request $request)
    {
        try {
            if ($request->isMethod('get')) {

            } else {
                $param = $request->all();
                if ($err = $this->validate->check($request->all(), 'add')) {
                    return Response::PcResponse(40000, $err, '', 200);
                }
                //level 父节点的level+1
                $level = 0;
                if ($param['pid'] != 0) {
                    $p_level = Permissions::where('id', $param['pid'])->value('level');
                }
                if (isset($p_level)) {
                    $level = $p_level + 1;
                }
                Permission::create(['name' => $param['name'], 'route' => $param['route'], 'pid' => $param['pid'], 'sort' => $param['sort'], 'level' => $level]);
                return Response::PcResponse(0, '添加成功', '', 200);
            }
        } catch (Exception $e) {
            return Response::PcResponse(520, '服务器错误', '', 200);
        }
    }

    //权限编辑
    public function edit(Request $request)
    {
        try {
            if ($request->isMethod('get')) {

            } else {
                if ($err = $this->validate->check($request->all(), 'edit')) {
                    return Response::PcResponse(40000, $err, '', 'edit');
                }
                $param = $request->all();
                Permissions::where('id', $param['id'])->update([
                    'name' => $param['name'],
                    'route' => $param['route'],
                    'pid' => $param['pid'],
                    'sort' => $param['sort'],
                ]);
                return Response::PcResponse(0, '修改成功', '', 200);
            }
        } catch (Exception $e) {
            return Response::PcResponse(520, '服务器错误', '', 200);
        }
    }
}
