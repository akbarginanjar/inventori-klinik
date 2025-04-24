<?php

namespace App\Imports;

use App\Models\S_Masuk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SMasukImport implements ToModel, WithHeadingRow, WithStartRow
{
    use Importable;

    public function model(array $row)
    {
        return new S_Masuk([
            'kode_obat_masuk' => $row['kode_obat_masuk'],
            'tanggal_masuk' => $this->parseDate($row['tanggal_masuk']),
            'supplier_id' => $this->getSupplierIdByName($row['nama_supplier']),
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

    private function getSupplierIdByName($name)
    {
        return \App\Models\Supplier::where('nama_supplier', $name)->first()->id;
    }

    private function getObatIdByName($name)
    {
        return \App\Models\Obat::where('nama_obat', $name)->first()->id;
    }
}
