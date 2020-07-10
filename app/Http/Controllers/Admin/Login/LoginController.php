<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController as Response;
use Mockery\Exception;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        try {
            return Response::PcResponse(0, '登录成功', '', 200);
        } catch (Exception $exception) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }
}
