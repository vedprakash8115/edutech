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
            'language' => 'required|integer', // Language should be an integer
            'original_price' => 'required|numeric|min:2',
            'discount_price' => 'nullable|numeric|min:2',
            'banner' => 'required|file',
            'video' => 'required|file',
            // 'course_duration' => 'required|string|min:2',
            'about_course' => 'required|string',
            'course_category_id' => 'required|integer', // Should be an integer
            'form' => 'required|date', // Date format validation
            'to' => 'required|date', // Date format validation
        ];
    }
}
