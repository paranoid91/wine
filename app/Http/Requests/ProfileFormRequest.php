<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileFormRequest extends Request
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
        $return  = [
            'name' => 'required|max:55',
            'surname' => 'required|max:55',
            'job_title' => 'required|max:255',
            'company_name' => 'required|max:255',
            'company_logo' => 'required|max:2000|mimes:png,jpeg,tiff',
            'activities' => 'required',
            'company_description' => 'required|min:10',
            'extra_fields.country_id' => 'required',
            'extra_fields.telepone_number' => 'required|digits_between:5,20',
            'extra_fields.accept_license' => 'required'
        ];
        if($this->method() == 'POST') {
            return $return;
        }
        if($this->method() == 'PATCH'){
            if($this->file('company_logo')){
                $return['company_logo'] = 'required|max:2000|mimes:png,jpeg,tiff';
            }else{
                $return['company_logo'] = 'required';
            }
            return $return;
        }
    }
}
