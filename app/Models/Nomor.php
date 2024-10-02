<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nomor extends Model
{
    use HasFactory, SoftDeletes;



    protected $fillable = [

        'jabatan_id', 'jenis_naskah_id', 'klasifikasi_id', 'tujuan', 'perihal', 'tanggal_surat', 'nomor_surat',
        'filename', 'status', 'tipe', 'plh_id', 'akses_naskah', 'id_pengguna'
    ];



    public function JenisNaskah()
    {
        return $this->belongsTo(JenisNaskah::class);
    }

    public function klasifikasis()
    {
        return $this->belongsTo(Klasifikasi::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function naskahs()
    {
        return $this->belongsTo(Naskah::class, 'naskah_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function akses_naskahs()
    {
        return $this->belongsTo(AksesNaskah::class, 'akses_naskah');
    }



    public function scopeFillter($query, $request)
    {
        $query->when($request->search, function ($query) use ($request) {

            $query->WhereHas('jabatan', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            });
            $query->orWhereHas('jenisNaskah', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            });
            $query->orWhereHas('users', function ($query) use ($request) {
                $query->where('nama_pengguna', 'like', '%' . $request->search . '%');
            });
        });
    }


    public function scopeFillterDate($query, $dateStart, $dateEnd)
    {
        $query->when($dateStart && $dateEnd, function ($query) use ($dateStart, $dateEnd) {
            $query->whereDate('tanggal_surat', '>=', $dateStart)
                ->whereDate('tanggal_surat', '<=', $dateEnd);
        });
    }
}
