<?php

namespace App\Http\Requests\Admin\Modules\Users;

use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
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
        switch ($this->request->get('request')) {
            case 'photo':
                $validationFields = [
                    'file' => 'required|numeric'
                ];
                break;

            default:
                $validationFields =  [
                    'email' => 'email|required|unique:users,email,' . $this->request->get('user_id'),
                    'role_id' => 'required|numeric',
                ];
                break;
        }

        return $validationFields;
    }
}
