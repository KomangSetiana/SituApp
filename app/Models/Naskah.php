<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Naskah extends Model
{

    use HasFactory, SoftDeletes;


    protected $fillable = ["nama"];


    // public function nomor()
    // {
    //     return $this->hasMany(Nomor::class);
    // }

    public function JenisNaskah()
    {
        return $this->hasMany(JenisNaskah::class);
    }

    public function scopeFillter($query, $request)
    {
        $query->when($request->search, function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        });
    }
}
