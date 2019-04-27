<?php

namespace App\Laravel\Models;

use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Str,Carbon,Helper;
class ActivityNotification extends Model
{

    use SoftDeletes,DateFormatterTrait;
    protected $table = "notifications";

    protected $casts = [
      'id' => 'string'
    ];
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'type', 'notifiable_id'
    ];

    /**
     * Get the user associated with this social account.
     */
    public function user() {
        return $this->belongsTo("App\Laravel\Models\User", "notifiable_id", "id");
    }


    public function scopeObjectRefId($query,$ref_id = NULL){
        if(env('DB_CONNECTION','sqlsrv') == "sqlsrv"){
            return $query->whereRaw("JSON_VALUE([data],'$.reference_id') = {$ref_id}");
        }else{
            return $query->whereRaw("JSON_EXTRACT(data,'$.reference_id') = {$ref_id}");
        }
    }

    public function scopeObjectIdentifier($query,$type = NULL){

        switch(Str::lower($type)){
            case 'comment':
                return $query->where('type',"App\Laravel\Notifications\WishlistComment\WishlistCommentCreated");
            break;

            case 'tagged':
                return $query->where('type',"App\Laravel\Notifications\WishlistComment\WishlistCommentTaggedUser");
            break;

            case 'comment_sawsaw':
                return $query->where('type',"App\Laravel\Notifications\WishlistComment\WishlistCommentCreatedOther");
            break;
        }
    }

    public function scopeObjectType($query,$selected_type = NULL){
        if(env('DB_CONNECTION','sqlsrv') == "sqlsrv"){
            return $query->whereRaw("JSON_VALUE([data],'$.type') = '{$selected_type}'");
        }else{
            return $query->whereRaw("JSON_EXTRACT(data,'$.type') = '{$selected_type}'");
        }
    }

    public function scopeObjectDate($query,$type = NULL){
        switch(Str::lower($type)){
            case 'today':
                if(env('DB_CONNECTION','sqlsrv') == "sqlsrv"){
                    $today = Helper::date_format(Carbon::now(),"m-d-Y");
                    $query->whereRaw("CONVERT(VARCHAR(10),created_at,110) = '{$today}'");
                }else{
                    $today = Carbon::now();
                    $query->whereRaw("DATE(created_at) = DATE('{$today}')");
                }
            break;
        }
    }
}

