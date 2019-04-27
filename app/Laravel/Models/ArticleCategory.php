<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategory extends Model
{
    use DateFormatterTrait,SoftDeletes;

	protected $table = "article_category";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public $timestamps = true;

}
