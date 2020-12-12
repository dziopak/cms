<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;

abstract class BaseApiRequest
{
    public function validation($data)
    {
        $validator = Validator::make($data, $this->rules());
        if ($validator->fails()) {
            $err = $validator->errors();
            $res = [];
            foreach ($err->getMessages() as $field => $msg) {
                $res[$field][] = $msg[0];
            }
            return $res;
        }
    }

    static function validate($data)
    {
        $class = new static;
        return $class->validation($data);
    }

    abstract function rules();
}
