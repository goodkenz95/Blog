<?php

namespace App\Laravel\Models;

use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDevice extends Model
{
    use SoftDeletes, DateFormatterTrait;

    protected $table = "user_device";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'reg_id', 'device_id', 'device_name', 'is_login'
    ];
}
