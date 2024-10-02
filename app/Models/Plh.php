<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plh extends Model
{
    use HasFactory;


    protected $fillable = ["jabatan_id", "tanggal"];

    public function jabatans()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }


    public function scopeFillter($query, $request)
    {
        $query->when($request->search, function ($query) use ($request) {
            $query->orWhereHas('jabatans', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%');
            });
        });
    }
}
