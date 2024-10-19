<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreliveClassRequest extends FormRequest
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
            'course_name' => 'required|string|max:255',
            'language' => 'required|integer',
         'is_paid' => 'boolean',
                'price' => 'nullable|numeric|min:0',
                'discount_price' => 'nullable|numeric|min:0',
           'course_duration' => 'required|',  // Should be integer if you store it as integer
            'cat_level_0' => 'required|integer',
            'cat_level_1' => 'nullable|integer',
            'cat_level_2' => 'nullable|integer',
            'from' => 'required|date',
            'to' => 'nullable|date',
            'about_course' => 'nullable|string',
        //    'course_pdfs.*' => 'nullable|file|mimes:pdf|max:2048',

            'banner' => 'nullable|file', // Ensure field name matches form input
        ];
    }
}
