<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlhRequest extends FormRequest
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
        $akhirTahun = Carbon::now('Asia/Makassar')->endOfYear();
        return [
            'jabatan_id' => 'required',
            'tanggal' => ['required', 'date', 'after_or_equal:today|before_or_equal:' . $akhirTahun,  Rule::unique('plhs', 'tanggal')]

        ];
    }

    public function messages()
    {
        return [
            "jabatan_id.required" => "Jabatan wajib diisi",
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.unique' => 'Plh di tanggal ini sudah ada.',
            'tanggal.before_or_equal' => 'Tidak boleh memasukan tanggal tahun depan.',
            'tanggal.after_or_equal' => 'Tidak boleh memasukan tanggal yang sudah lewat',


        ];
    }
}
