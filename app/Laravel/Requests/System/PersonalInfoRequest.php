<?php namespace App\Laravel\Requests\System;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class PersonalInfoRequest extends RequestManager{

	public function rules(){

		$id = $this->route('id')?:0;

		$rules = [
			
		];

		return $rules;
	}

	public function messages(){
		return [
			// 'required'	=> "Field is required.",
			// 'contact.phone'	=> "Please provide a valid PH mobile number.",
			// 'birthdate.date'	=> "Birthdate must be a valid date.",
			// 'website.url'	=> "Invalid URL format. Adding http:// or https:// is also needed.",
		];
	}
}