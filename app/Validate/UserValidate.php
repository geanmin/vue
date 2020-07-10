<?php
/**
 * Created by PhpStorm.
 * User: HXBR
 * Date: 2019/3/6
 * Time: 9:31
 */

namespace App\Validate;

class UserValidate extends Validate
{
    protected $rule = [
        'name' => 'required|max:255',
        'password' => 'required|max:16',
        'email' => 'required|E-Mail',
        'role_id' => 'required|numeric'
    ];

    protected $message = [
        'name.required' => '用户名不能为空',
        'password.required' => '密码不能为空',
        'email.required' => '邮箱不能为空',
        'role_id.required' => '角色不能为空',
    ];

    protected $scene = [
        'add' => ['name', 'password', 'role_id'],
        'edit' => ['name', 'password', 'role_id'],
    ];

}