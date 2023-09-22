<?php

namespace App\Http\Requests\Policy;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
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
        return [
            'type_id'=>'numeric',
            'provider_id'=>'numeric|exists:providers,id',
            'name' => 'required|string|max:128',
            'amount' => 'required|numeric',
            'coverage' => 'required|numeric',
            'description' => 'required|string',
        ];
    }
    protected function failedValidation(Validator $validator){
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json($errors,400)
        );
    }
}
