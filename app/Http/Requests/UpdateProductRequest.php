<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'images' => 'nullable|array',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a valid string.',
            'name.max' => 'The product name cannot exceed 255 characters.',
            'price.required' => 'The price of the product is required.',
            'price.numeric' => 'The price must be a valid number.',
            'categories.required' => 'You must select at least one category.',
            'categories.array' => 'The categories must be an array.',
            'categories.*.exists' => 'The selected category is invalid.',
            'images.array' => 'The images must be an array.',
            'images.*.image' => 'Each uploaded file must be an image.',
            'images.*.mimes' => 'The image must be of type jpeg, png, jpg, gif, or svg.',
        ];
    }
}
