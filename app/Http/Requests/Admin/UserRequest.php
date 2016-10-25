<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\User;


class UserRequest extends Request {

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
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {

                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users,email,'.$this->user->id,
                ];

            }
            default:break;
        }
    }


}
