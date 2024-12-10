<?php

namespace App\Exports;

use App\Models\Nomor;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class NaskahRejectedExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $dateStart;
    protected $dateEnd;
    protected $jabatanName;
    protected $jenisNaskahName;
    // Constructor to pass date range
    public function __construct(Carbon $dateStart, Carbon $dateEnd, $jabatanName = null, $jenisNaskahName = null)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->jabatanName = $jabatanName;
        $this->jenisNaskahName = $jenisNaskahName;
    }
    public function collection()
    {
        $query = Nomor::whereBetween('tanggal_surat', [$this->dateStart, $this->dateEnd])
            ->with([
                'jabatan' => function ($query) {
                    $query->select('id', 'nama'); // id diperlukan untuk join relasi
                },
                'users' => function ($query) {
                    $query->select('id_pengguna', 'nama_pengguna'); // id diperlukan untuk join relasi
                },
                'JenisNaskah' => function ($query) {
                    $query->select('id', 'nama');
                }
            ])->where('status', 'rejected');

        if ($this->jabatanName) {
            $query->whereHas('jenisNaskah', function ($q) {
                $q->where('nama', $this->jabatanName);
            });
        }

        if ($this->jenisNaskahName) {
            $query->whereHas('jenisNaskah', function ($q) {
                $q->where('nama', $this->jenisNaskahName);
            });
        }


        return $query->get();
    }

    public function headings(): array
    {
        return ['Pembuat Nomor', 'Penanda Tangan Naskah', 'Jenis Naskah', 'Nomor Naskah', 'Tanggal', 'Tujuan', 'Perihal', 'status']; // Header kolom
    }


    public function map($nomor): array
    {
        // dd($nomor->users->nama_pengguna);
        // Determine the status based on conditions
        if ($nomor->filename === null && $nomor->deleted_at !== null) {
            $status = 'Dibatalkan';
        } elseif ($nomor->filename === null && $nomor->deleted_at === null) {
            $status = 'Belum upload file';
        } else {
            $status = $nomor->status;
        }

        return [
            $nomor->users->nama_pengguna,  // Nama pengguna dari relasi
            $nomor->jabatan->nama,         // Nama jabatan dari relasi
            $nomor->jenisNaskah->nama,         // Nama jenis naskah dari relasi
            $nomor->nomor_surat,           // Kolom dari model Nomor
            $nomor->tanggal_surat,         // Kolom dari model Nomor
            $nomor->tujuan,                // Kolom dari model Nomor
            $nomor->perihal,               // Kolom dari model Nomor
            $status
        ];
    }
}
