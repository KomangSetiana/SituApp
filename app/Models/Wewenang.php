<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wewenang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['jabatan_id', 'jenis_naskah_id'];


    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function jenisNaskah()
    {
        return $this->belongsTo(JenisNaskah::class);
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
        });
    }
}
