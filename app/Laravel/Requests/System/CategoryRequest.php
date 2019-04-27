<?php namespace App\Laravel\Requests\System;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class CategoryRequest extends RequestManager{

	public function rules(){

		$id = $this->route('id')?:0;

		$rules = [
			'name'	=> "required|unique:article_category,name,{$id}",
		];

		return $rules;
	}

	public function messages(){
		return [
			'name.unique'	=> "Category name already used. Please double check your input.",
			'required'	=> "Field is required.",
		];
	}
}