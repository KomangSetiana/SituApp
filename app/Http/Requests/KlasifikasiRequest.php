<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KlasifikasiRequest extends FormRequest
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
            "kode" => "required|max:100",
            "nama" => "required|max:225"
        ];
    }


    public function messages()
    {
        return [
            'nama.required' => 'Klasifikasi wajib diisi.',
            "kode.required" => "Kode Klasifikasi wajib diisi",
            'nama.max:225' => 'Klasifikasi terlalu panjang.',
            'kode.max:100' => 'Kode terlalu panjang.',

        ];
    }
}
