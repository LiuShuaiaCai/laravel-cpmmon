<?php

namespace App\Models;

use App\Scope\SoftDelete\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * 日期时间的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';

    public $timestamps = true;


//    protected $casts = [
//        'created_at' => 'timestamp',
//    ];
}
