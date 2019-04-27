<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{

	protected $table = "password_resets";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token',
    ];

    public $timestamps = false;
}
