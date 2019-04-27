<?php

namespace App\Laravel\Models;

use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{

    protected $table = "user_social";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'provider_user_id', 'provider'
    ];

    /**
     * Get the user associated with this social account.
     */
    public function user() {
        return $this->belongsTo("App\Laravel\Models\User", "user_id", "id");
    }
}
