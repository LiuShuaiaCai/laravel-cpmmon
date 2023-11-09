<?php


namespace App\Http\Controllers\User;


use App\Constants\ErrorCode;
use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 删除用户
     *
     * @param $id
     * @return JsonResponse
     * @throws ApiException
     */
    public function delete($id): JsonResponse
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'int', Rule::exists('users', 'id')->where('deleted_at', 0)]
        ]);

        if ($validator->fails()) {
            throw new ApiException(ErrorCode::PARAMS_ERROR);
        }

        $this->userService->delete($id);

        return $this->success();
    }
}