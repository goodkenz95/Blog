<?php

namespace App\Laravel\Requests\System;

use App\Laravel\Requests\RequestManager;
// use JWTAuth;

class ArticleRequest extends RequestManager
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
            'file' => "required|image|max:5000",
            'title' => "required",
            'content'   => 'required',
            'category_id'  => "required|valid_category",
        ];

        if($id){
            $rules['file'] = "image";
        }

        if($this->has('video_url')){
            $rules['video_url'] = "url";
        }

        return $rules;
    }

    public function messages() {

        return [
            'required'  => "Field is required.",
            'file.max'  => "Image should not be exceeding to 5mb.",
            'category_id.valid_category'   => "Invalid category.",
        ];
    }
}
