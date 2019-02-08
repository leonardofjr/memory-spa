<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioEntryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
           return [
                'title' => 'required|min:2|max:25',
                'description' => 'required|min:50|max:1000',
                'website_url' => 'required',
                'file_1' => 'required',
        ];
    }

     public function messages()
    {
        return [
                'title.required' => 'Title field is required',
                'title.min' => 'Title must be greater than 2 characters',
                'title.max' => 'Title must be less than 25 characters',
                'description.required' => 'Description field is required',
                'description.max' => 'Description field must be less than 1000 characters',
                'description.min' => 'Description field must be greater than 50 characters',
                'website_url.required' => 'Website url field is required',
                'file_1.required' => 'Image is required',
        ];
    }
}
