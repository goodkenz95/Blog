<?php

namespace App\Laravel\Requests\System;

use App\Laravel\Requests\RequestManager;
// use JWTAuth;

class FileManagerRequest extends RequestManager
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->user();
        $id = $this->route('id') ?: 0;
        
        $rules = [
            'file' => "required|max:5000",
            'type' => "required",
            'custom_filename'   => 'required',
        ];


        return $rules;
    }

    public function messages() {

        return [
            'required'  => "Field is required.",
            'file.max'  => "File should not be exceeding to 5mb.",
        ];
    }
}
