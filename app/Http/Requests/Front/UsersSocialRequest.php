<?php

namespace App\Http\Requests\Front;

use App\Http\Requests\BaseFormRequest;
use Auth;

class UsersSocialRequest extends BaseFormRequest
{
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
