<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth,Helper;
class Article extends Model
{
    use DateFormatterTrait,SoftDeletes;

	protected $table = "article";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','content','video_url','video_source','category_id'];

    protected $appends = ['last_reaction','last_reaction_user_id','thumbnail','excerpt','new_directory'];

    public $timestamps = true;

    public function getNewDirectoryAttribute(){
        return str_replace(env("BLOB_STORAGE_URL"), env("CDN_STORAGE_URL"), $this->directory);
    }

    public function author(){
        return $this->hasOne('App\Laravel\Models\User','id','user_id');
    }

    public function category(){
        return $this->hasOne('App\Laravel\Models\ArticleCategory','id','category_id');
    }

    public function comment(){
        return $this->hasMany('App\Laravel\Models\ArticleComment','article_id','id');
    }

    public function reaction(){
        return $this->hasMany('App\Laravel\Models\ArticleReaction','article_id','id')->where('is_active','yes');
    }

    public function getExcerptAttribute(){
        return Helper::get_excerpt($this->content);
    }

    public function getThumbnailAttribute(){
        if($this->filename){
            return "{$this->new_directory}/resized/{$this->filename}";
        }

        return asset('placeholder/user.jpg');
    }

    public function getLastReactionUserIdAttribute(){
        $reaction = ArticleReaction::where('article_id',$this->id)->where('is_active','yes')->orderBy('updated_at','DESC')->first();

        if($reaction){
            return $reaction->user_id;
        }

        return false;
    }

    public function getLastReactionAttribute(){
        if($this->last_reaction_user_id){
            $user = User::find($this->last_reaction_user_id);

            if($user){
                if(Auth::check()){
                    if(Auth::user()->id == $user->id){
                        return "You";
                    }
                }
                return $user->name;
            }
            return "User";
        }

        return "User";
    }

    public function scopeKeyword($query, $keyword = NULL){
        if($keyword){
            $keyword = strtolower($keyword);
            return $query->whereRaw("LOWER(title) LIKE '{$keyword}%'")
                        ->orWhereRaw("LOWER(content) LIKE '{$keyword}%'");
        }
    }

    public function scopeCategories($query,$category_ids = NULL){
        if($category_ids){
            $categories = explode(",", $category_ids);
            return $query->whereIn('category_id',$categories);
        }
    }

}
