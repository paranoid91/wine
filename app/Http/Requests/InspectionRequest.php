<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InspectionRequest extends Request
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
            'receipted_at' => 'required',
            'cat.1' => 'required',
            'registration_number' => 'required',
            'vincode' => 'required',
            'cat.2' => 'required',
            'year' => 'required',
            'engine_volume' => 'required',
            'owner' => 'required',
            'phone' => 'required',
            'extra.details.*.name' => 'required',
            'extra.details.*.num' => 'required',
            'extra.details.*.condition' => 'required',
            'extra.details.*.price' => 'required',
            'extra.details.*.sum' => 'required',
            'extra.work.*.title' => 'required',
            'extra.work.*.price' => 'required',
        ];
    }
}
