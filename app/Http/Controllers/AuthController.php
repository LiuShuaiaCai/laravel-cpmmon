<?php

namespace App\Http\Controllers;

use App\Constants\ErrorCode;
use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * 用户注册
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $params       = $request->all();
        $params['ip'] = $request->getClientIp();

        $result = $this->authService->register($params);

        return $this->success($result);
    }

    /**
     * 用户登录
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        // 验证用户信息
        if (!$token = auth()->attempt($credentials)) {
            return $this->error(HttpResponse::HTTP_UNAUTHORIZED);
        }

        $result = [
            'token'      => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
        return $this->success($result);
    }


    /**
     * 获取用户信息
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function info(Request $request): JsonResponse
    {
        $journalId = $request->input('journal_id', 0);
        $result    = $this->authService->info($journalId);

        return $this->success($result);
    }


    /**
     * 退出登录
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return $this->success();
    }


    /**
     * 刷新Token
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $result = [
            'token'      => auth()->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
        return $this->success($result);
    }
}
