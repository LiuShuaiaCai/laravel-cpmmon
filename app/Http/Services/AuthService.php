<?php


namespace App\Http\Services;


use App\Constants\ErrorCode;
use App\Exceptions\ApiException;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    /**
     * 用户注册
     *
     * @param array $params
     * @return array
     */
    public function register(array $params): array
    {
        $params['password'] = Hash::make($params['password']);
        User::query()->create($params);
        return [];
    }


    /**
     * 登录用户信息
     *
     * @param int $journalId
     * @return Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function info(int $journalId = 0)
    {
        return User::query()
            ->with(['roles' => function(BelongsToMany $query) use ($journalId) {
                $journalIds = array_unique([0, $journalId]);
                $query->whereIn('user_roles.journal_id', $journalIds);
            }, 'roles.resources'])
            ->where('id', $this->userId)
            ->first();
    }
}