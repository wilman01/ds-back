<?php

namespace App\Http\Requests;

use App\Enums\Customer;
use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        //dd(request()->request);
        return [
            'cedula' => 'required|string|max:15',
            'name' => 'required|string|max:55',
            'last_name' => 'required|string|max:55',
            'gender' => new Enum(Gender::class),
            'email' => 'required|string|unique:customers|email',
            'phone' => 'required|string|max:20',
            'status' => [new Enum(Customer::class)]
        ];
    }


    protected function failedValidation(Validator $validator){
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json($errors,400)
        );

    }
}
