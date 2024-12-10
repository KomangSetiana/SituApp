<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ["nama", "filename"];

    public function scopeFillter($query, $request)
    {
        $query->when($request->search, function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        });
    }
}
