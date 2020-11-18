<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UsersSocialRequest extends FormRequest
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

        $user = Auth::user();

        if (empty($user->email)) {
            $validationFields =  [
                'email' => 'email|required|unique:users,email,' . Auth::user()->id,
            ];
        }

        if (empty($user->password)) {
            $validationFields['password'] = 'required|min:8|required_with:password_confirmation|same:password_confirmation';
            $validationFields['password_confirmation'] = 'required|min:8';
        }

        return $validationFields;
    }
}
