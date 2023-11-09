<?php


namespace App\Http\Services\User;


use App\Constants\ErrorCode;
use App\Exceptions\ApiException;
use App\Http\Services\BaseService;
use App\Models\User;

class UserService extends BaseService
{
    /**
     * 删除用户
     *
     * @param int $id
     * @return array
     * @throws ApiException
     */
    public function delete(int $id): array
    {
        $user = User::query()->find($id);
        if (!$user) {
            throw new ApiException(ErrorCode::CUSTOM_ERROR_DATA_NOT_EXISTS);
        }

        $user->delete();
        return [];
    }
}