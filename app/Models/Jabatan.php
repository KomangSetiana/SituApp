<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jabatan extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ["nama", "kode", "has_plh"];


    public function wewenang()
    {
        return $this->hasMany(Wewenang::class);
    }

    public function jenis_naskahs()
    {
        return $this->belongsToMany(JenisNaskah::class, 'wewenangs', 'jabatan_id', 'jenis_naskah_id');
    }
    public function nomors()
    {
        return $this->hasMany(Nomor::class);
    }
    public function plh()
    {
        return $this->hasMany(Plh::class);
    }

    public function scopeFillter($query, $request)
    {
        $query->when($request->search, function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
            $query->orWhere('kode', 'like', '%' . $request->search . '%');
        });
    }
}
