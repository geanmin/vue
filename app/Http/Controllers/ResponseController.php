<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Exception;

class ResponseController extends Controller
{
    /**
     * PC端返回数据
     */
    public static function PcResponse($code = 0, $msg = '', $data = '', int $httpCode = 200)
    {
        try {
            return response()->json([
                'code' => $code,
                'msg' => $msg,
                'data' => $data,
            ], $httpCode);
        } catch (Exception $e) {
            return response()->json([
                'code' => '500',
                'msg' => '服务器错误',
                'data' => ''
            ], $httpCode);
        }
    }
}
