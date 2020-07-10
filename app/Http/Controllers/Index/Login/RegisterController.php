<?php

namespace App\Http\Controllers\Index\Login;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Validate\RegisterMobileValidate;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController as Response;
use Mockery\Exception;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->validate = new RegisterMobileValidate();
    }


    //手机号注册
    public function registerMobile(Request $request)
    {
        try {
            $param = $request->all();
            if ($err = $this->validate->check($param, 'registerMobile')) {
                return Response::PcResponse(40000, $err, '', 200);
            }
            //同时记录并返回token
            $member = Member::create([
               'mobile' => $param['mobile'],
            ]);
            $user = Member::where('mobile',$param['mobile'])->first();
            $token = \JWTAuth::fromUser($user);
            return Response::PcResponse(0, '注册成功', $token, 200);
        } catch (Exception $exception) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }

    //密码注册
    public function registerPassword(Request $request)
    {
        try {

        } catch (Exception $exception) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }

    //测试数据
    public function test(Request $request)
    {
        try {
            echo 'aa';
            exit();
        } catch (Exception $exception) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }
}
