<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

class CustomerRequest extends Request
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
            'first_name' => 'required|between:2,50|alpha',
            'last_name' => 'required|between:2,50|alpha',
            'email' => 'required|email|unique:customers',
            'telephone' => 'required|integer|unique:customers|digits_between:8,15',
            'password' => 'required|between:8,255|confirmed',
            'address' => 'required|max:255',
            'city' => 'required|string|max:50',
            'post_code' => 'required|integer|digits_between:4,8',
            'region' => 'required|string|max:60',
            'confirm_policy' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }
}
