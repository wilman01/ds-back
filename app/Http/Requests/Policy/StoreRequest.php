<?php

namespace App\Http\Requests\Policy;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        //dd($this->request->all());
        return [
            'type_id'=>'required|numeric',
            'provider_id'=>'required|numeric|exists:providers,id',
            'name' => 'required|string|max:128',
            'coverage' => 'required|numeric',
            'description' => 'required|string',
            'details.*' => 'string',
            'groups.*'=>'array',
        ];
    }
    protected function failedValidation(Validator $validator){
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json($errors,400)
        );
    }
}
