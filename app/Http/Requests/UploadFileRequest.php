<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'file wajib diisi.',
            "file.mimes" => "file hanya boleh pdf atau word",
            'file.max:2048' => 'ukuran file terlalu besar maksimal 2mb.',

        ];
    }
}
