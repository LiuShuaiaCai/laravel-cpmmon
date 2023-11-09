<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Http\Services\User\RoleService;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }
}