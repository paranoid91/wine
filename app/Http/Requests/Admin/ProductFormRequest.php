<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ProductFormRequest extends Request
{


    /**
     * multiple serialize file upload error fix
     * @var array
     */
    protected $dontFlash = ['still','screening','trailer'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**ß
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if($this->method() == 'POST'){
            $rules = [
                'user_id'=>'required',
                'extra_fields.company_id'=>'required',
                'cat.0'=>'required',
                'cat.1'=>'required',
                'cat.2'=>'required',
                'title'=>'required|max:255',
                'still.0'=>'required',
                'year'=>'required|numeric',
                'extra_fields.country_id'=>'required',
//                'extra_fields.director'=>'required|max:100',
//                'extra_fields.writer' => 'required|max:100',
//                'extra_fields.casts.0'=>'required|max:255',
//                'extra_fields.production'=>'required|max:100',
//                'extra_fields.movie_status'=>'required|max:32',
                'extra_fields.resolution' =>'required|max:10',
                'text'=>'required',
                'extra_fields.episodes'=>'required|max:10|numeric',
                'extra_fields.run_time'=>'required',
                'still.*'=>'max:5000|mimes:png,jpeg,tiff',
                'screening.*'=>'max:300000,mimes:mp4,avi,flv,mkv',
                'trailer.0'=>'required',
                'trailer.*'=>'max:300000,mimes:mp4,avi,flv,mkv',
            ];
        }
        if($this->method() == 'PATCH'){
            $rules = [
                'user_id'=>'required',
                'extra_fields.company_id'=>'required',
                'cat.0'=>'required',
                'cat.1'=>'required',
                'cat.2'=>'required',
                'title'=>'required|max:255',
                'year'=>'required|numeric',
                'extra_fields.country_id'=>'required',
//                'extra_fields.director'=>'required|max:100',
//                'extra_fields.writer' => 'required|max:100',
//                'extra_fields.casts.0'=>'required|max:255',
//                'extra_fields.production'=>'required|max:100',
//                'extra_fields.movie_status'=>'required|max:32',
                'extra_fields.resolution' =>'required|max:10',
                'text'=>'required',
                'extra_fields.episodes'=>'required|numeric',
//                'extra_fields.run_time'=>'required|max:10',
                'still.*'=>'max:5000|mimes:png,jpeg,tiff',
                'screening.*'=>'max:300000,mimes:mp4,avi,flv,mkv',
                'trailer.*'=>'max:300000,mimes:mp4,avi,flv,mkv',
            ];
        }
        return $rules;
    }
}
