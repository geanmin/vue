<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Roles extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name',
        'guard_name',
        'status',
    ];

    //通过id获取拥有的权限
    public static function getPermissionsByRolesId($id = null)
    {
        $list = DB::table('role_has_permissions as r')->leftjoin('permissions as p','r.permission_id','=','p.id')->where('r.role_id',$id)->select('p.id')->pluck('id');

        return $list;
    }
}
