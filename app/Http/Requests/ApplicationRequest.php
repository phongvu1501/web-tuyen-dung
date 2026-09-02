<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+().\s-]{8,30}$/'],
            'address' => ['nullable', 'string', 'max:255'],
            'cv' => ['required', File::types(['pdf', 'doc', 'docx'])->max('5mb')],
            'cover_letter' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function messages(): array
    {
        return [
            'cv.required' => 'Vui lòng đính kèm CV.',
            'cv.mimes' => 'CV phải có định dạng PDF, DOC hoặc DOCX.',
            'cv.max' => 'CV không được lớn hơn 5 MB.',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ];
    }
}
