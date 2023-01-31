<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseBuilderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShareCarRequest extends Request
{
    use ApiResponseBuilderTrait;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'shares' => 'required|array|min:1',
            'shares.*' => 'required|array',
            'shares.*.customer_id' => 'required|exists:customers,id|distinct',
            'shares.*.percentage' => 'required|numeric|between:1,100'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->failureWithErrors(
            trans('api.validation_error'),
            $this->validationError,
            ['errors' => $validator->errors()],
            422
        ));
    }

    public function withValidator(Validator $validator)
    {

        $sum = array_sum(array_map(function ($array) {
            return $array['percentage'] ?? 0;
        }, $this->get('shares')));

        $validator->after(function ($validator) use ($sum) {
            if ($sum != 100) {
                $validator->errors()->add('sum', 'the sum of share pernetage must be 100 ');
            }
        });
    }
}
