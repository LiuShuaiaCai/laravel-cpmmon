<?php


namespace App\Http\Services\User;


use App\Http\Services\BaseService;
use App\Models\User\RoleModel;

class RoleService extends BaseService
{
    public function list(array $params)
    {
        $page = $params['page'] ?? 1;

        $result = RoleModel::query()
            ->paginate(10);

        return $result;
    }
}