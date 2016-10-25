<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class EventsFormRequest extends Request
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
            'title'=>'required|max:255',
            'published_at'=>'required',
            'finished_at'=>'required',
            'extra_fields.place'=>'required|max:255',
            'text'=>'required',
            'image.0'=>'required'
        ];
    }
}
