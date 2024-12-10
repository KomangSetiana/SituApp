<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNomorRequest extends FormRequest
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
        $awalTahun = Carbon::now('Asia/Makassar')->startOfYear();

        return [
            "tanggal_surat" => 'required|date|before_or_equal:today|after_or_equal:' . $awalTahun,
            "perihal" => "required",
            "tujuan" => "required",
            "proses_by" => "required"

        ];
    }
    public function messages()
    {
        return [
            "tujuan.required" => "Tujuan wajib diisi",
            "perihal.required" => "Perihal wajib diisi",
            'tanggal_surat.before_or_equal' => 'Tanggal yang dimasukan harus tanggal hari ini atau tanggal sebelum hari ini.',
            'tanggal_surat.after_or_equal' => 'Tidak boleh memasukan tanggal pada tahun yang sudah lewat.',
            "proses_by.required" => "proses by wajib diisi",
        ];
    }
}
