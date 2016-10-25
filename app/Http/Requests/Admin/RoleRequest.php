<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use App\Models\Admin\Role;

class RoleRequest extends Request {

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
                    'name' => 'required|max:100|unique:roles'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|max:100|unique:roles,name,'.$this->role->id,
                ];
            }
            default:break;
        }

    }

}
