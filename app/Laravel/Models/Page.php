<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth,Helper;
class Page extends Model
{
    use DateFormatterTrait,SoftDeletes;

	protected $table = "page";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','content'];

    protected $appends = ['excerpt'];

    public $timestamps = true;

    public function author(){
        return $this->hasOne('App\Laravel\Models\User','id','user_id');
    }

    public function getExcerptAttribute(){
        return Helper::get_excerpt($this->content);
    }

    public function scopeKeyword($query, $keyword = NULL){
        if($keyword){
            $keyword = strtolower($keyword);
            return $query->whereRaw("LOWER(title) LIKE '{$keyword}%'")
                        ->orWhereRaw("LOWER(content) LIKE '{$keyword}%'");
        }
    }

}
