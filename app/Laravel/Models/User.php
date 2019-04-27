<?php

namespace App\Laravel\Models;

use Carbon, Helper,Str,GeoIP,Request;
use App\Laravel\Models\Views\UserGroup;
use Illuminate\Notifications\Notifiable;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable, SoftDeletes, DateFormatterTrait;

    protected $table = "user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'contact_number',
        'password',
        'description', 'path', 'directory', 'filename', 
        'last_notification_check','currency','fb_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $appends = ['avatar','rating','num_rating','new_directory'];

    public function getCreatedAtAttribute($value)
    {
        $user_ip = GeoIP::getLocation(Request::ip());
        return Carbon::parse($value)->setTimezone($user_ip->timezone);
    }

    public function getUpdatedAtAttribute($value)
    {
        $user_ip = GeoIP::getLocation(Request::ip());
        return Carbon::parse($value)->setTimezone($user_ip->timezone);
    }

    public function getLastActivityAttribute($value)
    {
        $user_ip = GeoIP::getLocation(Request::ip());
        return Carbon::parse($value)->setTimezone($user_ip->timezone);
    }

    public function getLastLoginAttribute($value)
    {
        $user_ip = GeoIP::getLocation(Request::ip());
        return Carbon::parse($value)->setTimezone($user_ip->timezone);
    }

    public function getNewDirectoryAttribute(){
        return str_replace(env("BLOB_STORAGE_URL"), env("CDN_STORAGE_URL"), $this->directory);
    }

    public function getAvatarAttribute(){

        if($this->filename){
            return "{$this->new_directory}/resized/{$this->filename}";
        }

        if($this->fb_id){
            return "https://graph.facebook.com/{$this->fb_id}/picture?width=310&height=310#v=1.0";
        }

        return asset('placeholder/user.jpg');
    }

    public function getNumRatingAttribute(){
        switch(Str::lower($this->type)){
            case 'mentor':
                return Mentorship::where('mentor_user_id',$this->id)->count();
            break;
            case 'mentee':
                return Mentorship::where('mentee_user_id',$this->id)->count();
            break;
            default: return "0";
        }
    }

    public function getRatingAttribute(){
        switch(Str::lower($this->type)){
            case 'mentor':
                $rating = Mentorship::where('mentor_user_id',$this->id)->sum('mentee_rating');
                return Helper::mround($this->num_rating > 0 ? $rating/$this->num_rating : "0.0",1);
            break;
            case 'mentee':
                $rating = Mentorship::where('mentee_user_id',$this->id)->sum('mentor_rating');
                return Helper::mround($this->num_rating > 0 ? $rating/$this->num_rating : "0.0",1);
            break;
            default: return "0";
        }
    }

    
    /**
     * Get the devices for this user.
     */
    public function devices() {
        return $this->hasMany("App\Laravel\Models\UserDevice", "user_id");
    }

    /**
     * Get the devices for this user.
     */
    public function specialty() {
        return $this->hasOne('App\Laravel\Models\Specialty','id','specialty_id');
    }

    /**
     * Get the facebook account for this user.
     */
    public function facebook() {
        return $this->hasOne("App\Laravel\Models\UserSocial", "user_id")->where('provider', "facebook");
    }

    public function scopeRegistrationDate($query,$from,$to){
        return $query->where(function($query) use($from){
            if($from AND strlen($from) > 0){
                if(env('MASTER_DB_DRIVER','mysql') == "sqlsrv"){
                    $from = Helper::date_format($from,"Ymd");
                    return $query->orWhereRaw("CONVERT(VARCHAR(10),created_at,112) >= '{$from}'");
                }else{
                    return $query->orWhereRaw("DATE(created_at) >= DATE('{$from}')");
                }
            }
        })->where(function($query) use ($to){
            if($to AND strlen($to) > 0){
                if(env('MASTER_DB_DRIVER','mysql') == "sqlsrv"){
                    $to = Helper::date_format($to,"Ymd");
                    return $query->orWhereRaw("CONVERT(VARCHAR(10),created_at,112) <= '{$to}'");
                }else{
                    return $query->orWhereRaw("DATE(created_at) <= DATE('{$to}')");
                }
            }
        });
    }

   
    /**
     * Search users that match a keyword.
     */
    public function scopeKeyword($query, $keyword = "") {
        return $query->where(function($query) use($keyword) {
                    return $query->whereRaw("LOWER(email) LIKE '{$keyword}%'")
                    ->orWhereRaw("LOWER(username) LIKE '{$keyword}%'")
                    ->orWhereRaw("LOWER(name) LIKE '%{$keyword}%'");
                // ->orWhere('email', 'like', "%{$keyword}%");
                });
    }

    public function scopeAccount_type($query,array $types){
        if(count($types) > 0){
            return $query->whereIn('type',$types);
        }
    }


    /**
     * Route notifications for the FCM channel.
     *
     * @return string
     */
    public function routeNotificationForFcm()
    {
        return $this->devices()->where('is_login', '1')->pluck('reg_id')->toArray() ?: 'user123';
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return array
     */
    public function receivesBroadcastNotificationsOn()
    {
        // return [
        //     new PrivateChannel("USER.{$this->id}"),
        // ];

        return "user.{$this->id}";
    }

    /**
     * Get user's avatar
     */
    public function getAvatar() {

        if($this->fb_id){
            return "https://graph.facebook.com/{$this->fb_id}/picture?width=310&height=310#v=1.0";
        }

        return asset('assets/img/avatar4.png');
    }


    public function scopeTypes($query,array $types){
        if(count($types) > 0){
            return $query->whereIn('type',$types);
        }
    }

}
