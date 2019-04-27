<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{

	protected $table = "email_verification";

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
