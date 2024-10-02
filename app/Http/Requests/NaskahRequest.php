<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NaskahRequest extends FormRequest
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
            "nama" => "required|max:225"
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Tipe naskah wajib diisi.',
            'nama.max:225' => 'Tipe naskah terlalu panjang.',

        ];
    }
}
