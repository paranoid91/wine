<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class NewsFormRequest extends Request
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
            //'cat.0'=>'required',
            'title'=>'required|min:1|max:255',
            'text'=>'required',
            //'image.0'=>'required'
        ];
    }
}
