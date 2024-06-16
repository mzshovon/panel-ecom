<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            "sku" => "required|string|max:20|unique:products,sku",
            "price" => "required|numeric",
            "previous_price" => "nullable|numeric",
            "height" => "nullable|numeric",
            "weight" => "nullable|numeric",
            "discount" => "nullable|integer|max:80",
            "discount_type" => "nullable|string|in:percentage,amount",
            "discount_level" => "nullable|numeric",
            "variants" => "nullable|array",
            "description" => "required|string",
            "short_description" => "nullable|string",
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:3000'
        ];
    }
}
