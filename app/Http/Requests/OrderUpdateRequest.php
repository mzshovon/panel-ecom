<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            "name" => "required|string|max:80",
            "address" => "required|string|max:500",
            "notes" => "nullable|string|max:200",
            "quantity" => "required|numeric",
            "total_amount" => "required|string",
            "shipping_charge" => "required|string",
            "total_discount" => "nullable|string",
            "total_amount_after_discount" => "required|string",
            "status" => "required|string",
            "payment_type" => "required|string|in:Cash on delivery,Payment Gateway,card,mfs",
        ];
    }
}
