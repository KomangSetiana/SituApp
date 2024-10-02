<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WewenangRequest extends FormRequest
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
            "jabatan_id" => "required",
            "jenis_naskah_id" => "required",
        ];
    }
    public function messages()
    {
        return [
            "jabatan_id.required" => "Jabatan wajib diisi",
            "jenis_naskah_id.required" => "Jenis naskah wajib diisi",


        ];
    }
}
