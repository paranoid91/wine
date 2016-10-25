<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
        return [
            'cat.0'=>'required',
            'cat.1'=>'required',
            'cat.2'=>'required',
            'title'=>'required|min:1|max:255',
            'price' => 'required|digits_between:1,8|numeric|min:0',
            'description'=>'required',
            //'image.0'=>'required',
        ];
    }
}
