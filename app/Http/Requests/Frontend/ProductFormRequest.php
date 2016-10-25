<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class ProductFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if($this->method() == 'POST') {
            $rules = [
                'cat.0' => 'required',
                'cat.1' => 'required',
                'cat.2' => 'required',
                'title' => 'required|max:255',
                'still.0' => 'required|max:5000|mimes:png,jpeg,tiff',
                'year' => 'required|numeric',
                'extra_fields.country_id' => 'required|numeric',
                'extra_fields.director' => 'required|max:100',
                'extra_fields.writer' => 'required|max:100',
                'extra_fields.casts.*' => 'required',
//                'extra_fields.production' => 'required|max:100',
                'extra_fields.movie_status' => 'required|max:32',
                'extra_fields.resolution' => 'required|max:10',
                'text' => 'required',
                'extra_fields.episodes' => 'required',
                'extra_fields.run_time' => 'required'
            ];
        }
        if($this->method() == 'PATCH'){
            $rules = [
                'cat.0' => 'required',
                'cat.1' => 'required',
                'cat.2' => 'required',
                'title' => 'required|max:255',
                'year' => 'required|numeric',
                'extra_fields.country_id' => 'required|numeric',
                'extra_fields.director' => 'required|max:100',
                'extra_fields.writer' => 'required|max:100',
                'extra_fields.casts.*' => 'required',
//                'extra_fields.production' => 'required|max:100',
                'extra_fields.movie_status' => 'required|max:32',
                'extra_fields.resolution' => 'required|max:10',
                'text' => 'required',
                'extra_fields.episodes' => 'required',
                'extra_fields.run_time' => 'required',
                'still.*'=>'max:5000|mimes:png,jpeg,tiff',
                'screening.*'=>'max:300000,mimes:mp4,avi,flv,mkv,mov',
                'trailer.*'=>'max:150000,mimes:mp4,avi,flv,mkv,mov,mpeg,mpe,vob,dat,mpg,wmv,wm,asf,asx,rm,rmvb,ra,ram,3gp,mp4v',
            ];

        }

        return $rules;
    }
}
