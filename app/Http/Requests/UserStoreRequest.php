<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:100",
            "email" => "required|email|unique:users,email",
            "password" => "required|alpha_num|confirmed|min:8",
            "status" => "required|integer|in:0,1",
            "city" => "nullable|string|max:50",
            "state" => "nullable|string|max:50",
            "zip" => "nullable|string|max:8",
            "address" => "nullable|string|max:1000",
        ];
    }
}
