<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/22
 * Time: 15:41
 */

namespace App\Validate;


class PermissionsValidate extends Validate
{
    public $rule = [
        'name' => 'required|max:255',
        'pid' => 'required|numeric',
        'route' => 'required',
    ];

    public $message = [
        'name.required' => '权限名称不能为空',
        'pid.required' => '父节点必须是数值',
        'route.required' => '路由不能为空',
    ];

    public $scene = [
        'add' => ['name', 'pid', 'route'],
        'edit' => ['name', 'pid', 'route'],
    ];
}