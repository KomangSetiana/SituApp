<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpadateTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'nama' => 'required',
            'filename' => 'nullable|mimes:pdf,doc,docx|max:2048'

        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Jabatan wajib diisi.',

        ];
    }
}
