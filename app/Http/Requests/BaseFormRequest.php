<?php

namespace App\Http\Requests;

use Illuminate\Routing\Redirector;
use Illuminate\Foundation\Http\FormRequest;

class BaseFormRequest extends FormRequest
{
    private $authorized = false;

    public function convertRequest(string $request_class): BaseFormRequest
    {
        $Request = $request_class::createFrom($this);

        $app = app();
        $Request
            ->setContainer($app)
            ->setRedirector($app->make(Redirector::class));

        $Request->prepareForValidation();
        $Request->getValidatorInstance();

        return $Request;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function withValidator($validator)
    {
        if ($validator->fails()) {
            $this->failedValidation($validator);
        }
    }
}
