<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AdminNomorRequest extends FormRequest
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
        // dd(Carbon::now());
        return [
            "jabatan_id" => "required",
            "jenis_naskah_id" => "required",
            "klasifikasi_id" => "required",
            "tanggal_surat" => 'required|date|before_or_equal:today|after_or_equal:' . $awalTahun,
            "nomor_surat" => "max:255",
            "filename" => "nullable",
            "perihal" => "required",
            "tujuan" => "required",
            "plh_id" => "nullable",
            "akses_naskah" => "nullable",
            "id_pengguna" => "required",
            "proses_by" => "required"
        ];
    }

    public function messages()
    {
        return [
            "jabatan_id.required" => "Jabatan wajib diisi",
            "jenis_naskah_id.required" => "Jenis naskah wajib diisi",
            "klasifikasi_id.required" => "Klasifikasi wajib diisi",
            "tujuan.required" => "Tujuan wajib diisi",
            "perihal.required" => "Perihal wajib diisi",
            'tanggal_surat.before_or_equal' => 'Tanggal yang dimasukan harus tanggal hari ini atau tanggal sebelum hari ini.',
            'tanggal_surat.after_or_equal' => 'Tidak boleh memasukan tanggal pada tahun yang sudah lewat.',
            "proses_by.required" => "proses by wajib diisi",
            "id_pengguna.required" => "penerima nomor wajib diisi",



        ];
    }
}
