<?php


namespace App\Http\Services;


use Illuminate\Support\Facades\Auth;

class BaseService
{
    protected $userInfo;
    protected $userId = 0;

    public function __construct()
    {
        $this->userInfo = Auth::user();
        if ($this->userInfo) {
            $this->userId = $this->userInfo['id'];
        }
    }
}