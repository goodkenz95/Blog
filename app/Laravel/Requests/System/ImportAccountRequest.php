<?php namespace App\Laravel\Requests\System;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class ImportAccountRequest extends RequestManager{

	public function rules(){

		// $id = $this->route('id')?:0;
		$id = Auth::user()->id;

		$rules = [
			'file'	=> "required|mimes:xls,xlsx,application/excel,application/vnd.ms-excel,application/vnd.msexcel",
			
		];

		return $rules;
	}

	public function messages(){
		return [
			'required'	=> "Please upload an excel file.",
			'file.mimes' => "Invalid excel format or .xlsx format only.",
		];
	}
}