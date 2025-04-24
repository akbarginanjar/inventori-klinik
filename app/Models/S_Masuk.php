<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class S_Masuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_obat_masuk',
        'tanggal_masuk',
        'supplier_id',
        'obat_id',
        'qty',
        'user_id',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
