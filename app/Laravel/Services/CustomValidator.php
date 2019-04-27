<?php 

namespace App\Laravel\Services;

use App\Laravel\Models\User;
use App\Laravel\Models\ArticleCategory;

use Illuminate\Validation\Validator;
use Auth, Hash,Str,Input;

class CustomValidator extends Validator {

    public function validateNewPhone($attribute,$value,$parameters){
        $user_id = isset($parameters[0]) ? $parameters[0] : "0";

        $is_correct = User::where('temp_contact_number',$value)
                        ->where('id',$user_id)
                        ->first();

        return $is_correct ? TRUE : FALSE;
    }

    public function validateValidOtp($attribute,$value,$parameters){
        $user_id = isset($parameters[0]) ? $parameters[0] : "0";

        $user = User::find($user_id);

        return $user->otp_value == $value ? TRUE : FALSE;
    }

    public function validateUniquePhone($attribute,$value,$parameters){
        $user_id = isset($parameters[0]) ? $parameters[0] : "0";
        $country_code = Input::get('country_code',"+63");

        $mobile_number = str_replace($country_code, "", $value);
        $mobile_number = strpos($mobile_number, "0",0) == "0" ? substr($mobile_number, 1) : $mobile_number;

        // $mobile_number = strpos($value, "+",0) !== FALSE ? str_replace($country_code, "", $value) : substr($value, 1);
        $final_contact_number = "{$country_code}{$mobile_number}";

        $user = User::where('id',"<>",$user_id)->where('contact_number',$final_contact_number)->first();

        return (!$user) ? TRUE : FALSE;
    }

    public function validateUniqueContact($attribute,$value,$parameters){
        $user_id = isset($parameters[0]) ? $parameters[0] : "0";
        
        $country_code = Input::get('country_code',"+63");
        // $mobile_number = strpos($value, "+",0) !== FALSE ? str_replace($country_code, "", $value) : substr($value, 1);

        $mobile_number = str_replace($country_code, "", $value);
        $mobile_number = strpos($mobile_number, "0",0) == "0" ? substr($mobile_number, 1) : $mobile_number;
        
        $final_contact_number = "{$country_code}{$mobile_number}";

        $user = User::where('id',"<>",$user_id)->where('contact_number',$final_contact_number)->first();

        return (!$user ) ? TRUE : FALSE;
    } 

    public function validateValidCategory($attribute,$value,$parameters){
        return ArticleCategory::find($value);
    }

    public function validateValidAccount($attribute, $value, $parameters){
        $valid_accounts = ['mentor','mentee'];
        return in_array(Str::lower($value), $valid_accounts);
    }

    public function validateOldPassword($attribute, $value, $parameters){
        
        if($parameters){
            $user_id = $parameters[0];
            $user = User::find($user_id);
            return Hash::check($value,$user->password);
        }

        return FALSE;
    }

    public function validateValidCurrency($attribute,$value,$parameters){
        $code = Str::lower($value);
        $check = Currency::whereRaw("LOWER(code) = '{$code}'")->first();

        if($check){
            return TRUE;
        }

        return FALSE;
    }

    public function validateIsFollowing($attribute,$value,$parameters){
        $user_id = Input::user()->id;

        return Follower::where('user_id',(int)$value)->where('follower_id',$user_id)
                        ->count() ? TRUE : FALSE;
    }

    public function validatePasswordFormat($attribute,$value,$parameters){
        return preg_match(("/^(?=.*)[A-Za-z\d!@#$%^&*()_+.]{6,25}$/"), $value);
    }

    public function validateUsernameFormat($attribute,$value,$parameters){
        return preg_match(("/^(?=.*)[A-Za-z\d][A-Za-z\d._+]{6,20}$/"), $value);
    }

    public function validateUniqueUsername($attribute,$value,$parameters){
    	$username = Str::lower($value);
        $user_id = FALSE;
        if($parameters){
            $user_id = $parameters[0];
        }

        if($user_id){
            $is_unique = User::where('id','<>',$user_id)->whereRaw("LOWER(username) = '{$username}'")->whereIn('type',['user'])->first();
        }else{
            $is_unique = User::whereRaw("LOWER(username) = '{$username}'")->whereIn('type',['user'])->first();
        }

        return $is_unique ? FALSE : TRUE;
	}

    public function validateUniqueEmail($attribute,$value,$parameters){
    	$email = Str::lower($value);
        $user_id = FALSE;
        if($parameters){
            $user_id = $parameters[0];
        }

        if($user_id){
            $is_unique = User::where('id','<>',$user_id)
                            ->where(function($query){
                                return $query->whereRaw("fb_id IS NULL")
                                            ->orWhereRaw("google_id IS NULL");
                            })->whereRaw("LOWER(email) = '{$email}'")->whereIn('type',['user'])->first();
        }else{
            $is_unique = User::whereRaw("LOWER(email) = '{$email}'")
                            ->where(function($query){
                                return $query->whereRaw("fb_id IS NULL")
                                            ->orWhereRaw("google_id IS NULL");
                            })->whereIn('type',['user'])->first();
        }

        return $is_unique ? FALSE : TRUE;
	}

} 