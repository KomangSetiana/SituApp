<?php

namespace App\Exports;

use App\Models\Nomor;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NomorExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */


    protected $dateStart;
    protected $dateEnd;
    // Constructor to pass date range
    public function __construct(Carbon $dateStart, Carbon $dateEnd)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }
    public function collection()
    {
        return Nomor::whereBetween('tanggal_surat', [$this->dateStart, $this->dateEnd])
            ->with([
                'jabatan' => function ($query) {
                    $query->select('id', 'nama'); // id diperlukan untuk join relasi
                },
                'users' => function ($query) {
                    $query->select('id', 'nama_pengguna'); // id diperlukan untuk join relasi
                }
            ])->where('status', 'approved')
            ->get();
    }

    public function headings(): array
    {
        return ['Pembuat Nomor', 'Penanda Tangan Naskah', 'Nomor Naskah', 'Tanggal', 'Tujuan', 'Perihal']; // Header kolom
    }


    public function map($nomor): array
    {
        return [
            $nomor->users->nama_pengguna,  // Nama pengguna dari relasi
            $nomor->jabatan->nama,         // Nama jabatan dari relasi
            $nomor->nomor_surat,           // Kolom dari model Nomor
            $nomor->tanggal_surat,         // Kolom dari model Nomor
            $nomor->tujuan,                // Kolom dari model Nomor
            $nomor->perihal                // Kolom dari model Nomor
        ];
    }
}
