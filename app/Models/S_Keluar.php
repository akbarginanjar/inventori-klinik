<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_Keluar extends Model
{
    use HasFactory;

    // Menentukan atribut yang dapat diisi
    protected $fillable = [
        'kode_obat_keluar',
        'tanggal_keluar',
        'obat_id',
        'qty',
        'user_id',
    ];

    // Mendefinisikan hubungan dengan model Obat
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    // Mendefinisikan hubungan dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
