<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RoleModel extends BaseModel
{
    protected $table = 'roles';


    /**
     * 角色的资源权限
     *
     * @return BelongsToMany
     */
    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(ResourceModel::class, 'role_resources', 'role_id', 'resource_id');
    }
}
