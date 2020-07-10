<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ResponseController as Response;
use Mockery\Exception;

class PowerController extends Controller
{
    //获取权限
    public function getPower(Request $request)
    {
        try {

        } catch (Exception $exception) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }
}
