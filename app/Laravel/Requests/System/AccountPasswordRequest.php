<?php namespace App\Laravel\Requests\System;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class AccountPasswordRequest extends RequestManager{

	public function rules(){

		// $id = $this->route('id')?:0;
		$id = Auth::user()->id;

		$rules = [
			'current_password'		=> "required|old_password:{$id}",
			'password'		=> "required|confirmed",
		];

		return $rules;
	}

	public function messages(){
		return [
			'required'	=> "Field is required.",
			'password.confirmed' => "Password mismatch.",
			'current_password.old_password' => "Invalid password. Unable to proceed request.",
		];
	}
}