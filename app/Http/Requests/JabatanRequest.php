<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JabatanRequest extends FormRequest
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
            "nama" => "required|max:225",
            "kode" => "required|max:100",
            "has_plh" => "nullable"
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Jabatan wajib diisi.',
            "kode.required" => "Kode Jabatan wajib diisi",
            'nama.max:225' => 'Jabatan terlalu panjang.',
            'kode.max:100' => 'Kode terlalu panjang.',

        ];
    }
}
