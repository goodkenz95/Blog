<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleReaction extends Model
{
    use DateFormatterTrait,SoftDeletes;

	protected $table = "article_reaction";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public $timestamps = true;


    public function author(){
        return $this->belongsTo("App\Laravel\Models\User", "user_id", "id");
    }

    public function article(){
        return $this->belongsTo("App\Laravel\Models\Article", "article_id", "id");
    }

}
