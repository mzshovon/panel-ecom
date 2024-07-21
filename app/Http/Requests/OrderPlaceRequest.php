<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPlaceRequest extends FormRequest
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
            "first_name" => "required|string|max:40",
            "last_name" => "required|string|max:40",
            "mobile" => "required|string|max:13",
            "email" => "nullable|string|max:80",
            "address" => "required|string|max:500",
            "division" => "required|string",
            "city" => "nullable|string|max:100",
            "area" => "nullable|string|max:100",
            "city" => "nullable|string|max:100",
            "notes" => "nullable|string|max:200",
            "payment_type" => "required|string|in:cash on delivery,card,mfs",
        ];
    }
}
