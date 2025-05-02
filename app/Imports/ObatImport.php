<?php

namespace App\Imports;

use App\Models\Jenis;
use App\Models\Obat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ObatImport implements ToModel, WithHeadingRow, WithStartRow
{
    public function model(array $row)
    {
        $jenis = Jenis::firstOrCreate(['nama_jenis' => $row['jenis_obat']]);

        $lastObat = Obat::orderBy('kode_obat', 'desc')->first();

        // Generate kode obat baru
        if (!$lastObat) {
            $kodeObat = 'KH-00001';
        } else {
            $lastKode = $lastObat->kode_obat;
            $number = (int) substr($lastKode, 5);
            $newNumber = str_pad($number + 1, 5, '0', STR_PAD_LEFT);
            $kodeObat = 'KH-' . $newNumber;
        }

        return new Obat([
            'kode_obat' => $kodeObat,
            'nama_obat' => $row['nama_obat'],
            'jenis_id' => $jenis->id,
            'stok' => 0
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
