<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class RegisterStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_name' => 'required|string',
            'employee_code' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'password' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'state' => [
                'required',
                Rule::exists('states', 'id')->where(function ($query) {
                    $query->where('country_id', request()->input('country'));
                }),
            ],
            'city' => [
                'required',
                Rule::exists('cities', 'id')->where(function ($query) {
                    $query->where('state_id', request()->input('state'));
                }),
            ],
            'zip' => 'required|numeric',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()
        ], 422));
    }
}
