<?php

namespace App\Http\Requests;

use App\Classes\ErrorResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        ErrorResponse::validationError($validator);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'media_id' => 'nullable|exists:media,id',
        ];
    }
}
