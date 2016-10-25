<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class PageFormRequest extends Request
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
            'cat'=>'required|numeric',
            'title'=>'required|max:255|min:1',
            'text'=>'required'
        ];
    }
}
