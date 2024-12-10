<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisNaskah extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["nama", "kode", "naskah_id", "akses_naskah", "has_direktur"];


    public function naskah()
    {
        return $this->belongsTo(Naskah::class, 'naskah_id');
    }
    public function wewenang()
    {
        return $this->hasMany(Wewenang::class);
    }

    public function nomors()
    {
        return $this->hasMany(Nomor::class);
    }

    public function scopeFillter($query, $request)
    {
        $query->when($request->search, function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
            $query->orWhere('kode', 'like', '%' . $request->search . '%')
                ->orWhereHas('naskah', function ($query) use ($request) {
                    $query->where('nama', 'like', '%' . $request->search . '%');
                });
        });
    }
}
