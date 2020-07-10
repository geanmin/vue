<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/19
 * Time: 16:28
 */

namespace App\Validate;


use Illuminate\Support\Facades\Validator;
use App\Validate\Validate;

class RolesValidate extends Validate
{

    protected $rule = [
        'name' => 'required|max:255',
        'rules' => 'required',

    ];
    protected $message = [
        'name.required' => '角色名不能为空',
        'rules.required' => '权限列表不能为空',
    ];
    protected $scene = [
        'add' => ['name', 'rules'],
        'edit' => ['name', 'rules'],
    ];

}