<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return true;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'item.category.required' => 'You must choose a category',
            'item.name.required' => 'Product name is required',
            'item.name.max' => 'Product name cannot be more than 14 characters',
            'item.name.string' => 'Product name must be letters only',

            'item.price.numeric' => 'Product price must contain only numbers',
            'item.price.required' => 'Product price is required',
            'item.price.max' => 'Product price must not be greater than 5 numbers',
            'item.price.min' => 'Product price must be at least 0',

            'item.available.integer' => 'Product quantity must contain only numbers',
            'item.available.required' => 'Product quantity is required',
            'item.available.max' => 'Product quantity must not be greater than 5 numbers',
            'item.available.min' => 'Product quantity must be at least 0',

            'item.weight.numeric' => 'Product weight must contain only numbers and use "." to seperate decimals.',
            'item.weight.required' => 'Product weight is required',
            'item.weight.max' => 'Product weight must not be greater than 5 numbers',
            'item.weight.min' => 'Product weight must be at least 0',


        ];
    }
    public function rules()
    {
        return [
            'item.category' => ['required'],
            'item.name' => ['required', 'string', 'max:14'],
            'item.price' => ['required','numeric', 'max:99999', 'min:0'],
            'item.available' => ['required', 'integer', 'max:99999', 'min:0'],
            'item.weight' => ['required','numeric', 'max:99999', 'min:0'],
            ];
    }
}
