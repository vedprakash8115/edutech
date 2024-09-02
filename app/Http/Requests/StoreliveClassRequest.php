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
            'course_name' => 'required|string|max:255|min:3',
            'language' => 'required|string',
            'original_price' => 'required|numeric|min:2',
            'discount_price' => 'nullable|numeric|min:2',
            'upload_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'course_duration' => 'required|string|min:2|max:255',
            'about_course' => 'required|string',
            'course_category' => 'required|string'
        ];
    }
}
