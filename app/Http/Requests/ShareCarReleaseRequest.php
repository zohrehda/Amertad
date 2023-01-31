<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ShareCarReleaseRequest extends Request
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $car = $this->route('car');
        return [
            'customer_id' => [
                'required',
                Rule::exists('shared_cars', 'customer_id')->where('car_id', $car->id)
            ]
        ];
    }
}
