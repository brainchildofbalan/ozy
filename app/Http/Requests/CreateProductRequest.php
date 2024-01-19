<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'specifications' => 'required|string',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'quantity_in_stock' => 'required|integer|min:0',
            'images' => 'required',
            'related_products' => 'required',
            'is_featured' => 'required',
            'is_valuable' => 'required',
            'product_code' => 'required|string|max:255',
        ];
    }
}