<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/1
 * Time: 13:59
 */

namespace App\Validate;


class RegisterMobileValidate extends Validate
{

    public $rule = [
        'mobile' => 'required|size:11',
        'code' => 'required',
    ];

    public $message = [
        'mobile.required' => '手机号不能为空',
        'mobile.max' => '手机号必须为11位',
        'code.required' => '验证码不能为空',
    ];

    public $scene = [
        'registerMobile' => ['mobile', 'code']
    ];
}

;