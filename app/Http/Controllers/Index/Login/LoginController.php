<?php

namespace App\Http\Controllers\Index\Login;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index\Common\AuthController;
use Illuminate\Http\Request;
use Mockery\Exception;
use App\Http\Controllers\ResponseController as Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Member;
use Illuminate\Support\Facades\DB;


class LoginController extends AuthController
{
    public function __construct()
    {
       parent::__construct();
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        try {
            $credentials = request(['name', 'password']);
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        } catch (Exception $exception) {
            return Response::PcResponse(500, '服务器错误', '', 200);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    //获取user信息
    public function getUser(Request $request)
    {
        $param = $request->all();
//        var_dump($param);exit();
        $user = auth('api')->user();
        return response()->json($user);
    }
}
