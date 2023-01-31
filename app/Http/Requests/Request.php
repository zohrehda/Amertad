<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseBuilderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class Request extends FormRequest
{
    use ApiResponseBuilderTrait;


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->failureWithErrors(
            trans('api.validation_error'),
            $this->validationError,
            ['errors' => $validator->errors()],
            422
        ));
    }
}
