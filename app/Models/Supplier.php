<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_supplier',
        'no_telepon',
        'alamat',
    ];

    public function s_masuk() {
        return $this->hasMany(S_Masuk::class, 'supplier_id');
    }
}
