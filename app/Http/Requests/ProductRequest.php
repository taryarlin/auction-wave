<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string',
            'category_id' => 'required',
            'starting_price' => 'required|numeric',
            'fixed_price' => 'required|numeric',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date',
            'buyer_premium_percent' => 'required|numeric',
            'bid_increment' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'file|mimes:jpg,jpeg,png,gif',
            'description' => 'required|string',
            'delivery_option' => 'required|string'
        ];
    }
}
