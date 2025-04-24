<?php

namespace App\Imports;

use App\Models\S_Keluar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SKeluarImport implements ToModel, WithHeadingRow, WithStartRow
{
    use Importable;

    public function model(array $row)
    {

        \Log::info('Importing row:', $row);
        return new S_Keluar([
            'kode_obat_keluar' => $row['kode_obat_keluar'],
            'tanggal_keluar' => $this->parseDate($row['tanggal_keluar']),
            'obat_id' => $this->getObatIdByName($row['nama_obat']),
            'qty' => $row['qty'],
            'user_id' => Auth::id()
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    private function parseDate($dateString)
    {
        if (is_numeric($dateString)) {
            return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateString))->format('Y-m-d');
        }

        return Carbon::parse($dateString)->format('Y-m-d');
    }


    private function getObatIdByName($name)
    {
        return \App\Models\Obat::where('nama_obat', $name)->first()->id;
    }
}
