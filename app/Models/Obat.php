<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'stok',
        'jenis_id',
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function sMasuks()
    {
        return $this->hasMany(S_Masuk::class);
    }
}
