<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth,Helper;

class Rating extends Model
{
    use DateFormatterTrait, SoftDeletes;

    protected $table = "ratings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'rating', 'description', 'type'];
    public $timestamps = true;
}
