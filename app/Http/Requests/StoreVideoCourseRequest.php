<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoCourseRequest extends FormRequest
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
            'banner' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'about_course' => 'nullable|string', // Changed to nullable for optional updates
            'course_category_id' => 'required|integer',
            'from' => 'required|date',
            'to' => 'required|date',
            'course_validity' => 'nullable|string',
            'subject' => 'nullable',
            'show_on_website' => 'nullable'
        ];
    }
}
