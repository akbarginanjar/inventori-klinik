<?php

namespace App\Exports;

use App\Models\S_Masuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SMasukExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Mengambil data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return S_Masuk::with('supplier', 'obat')->get(); // Mengambil data dengan relasi
    }

    /**
     * Menentukan heading kolom.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode Obat Masuk',
            'Tanggal Masuk',
            'Nama Supplier',
            'Nama Obat',
            'Qty',
        ];
    }

    /**
     * Memetakan data dari model ke format yang diekspor.
     *
     * @param $smasuk
     * @return array
     */
    public function map($smasuk): array
    {
        return [
            $smasuk->kode_obat_masuk,
            $smasuk->tanggal_masuk,
            $smasuk->supplier->nama_supplier,
            $smasuk->obat->nama_obat,
            $smasuk->qty,
        ];
    }
}
