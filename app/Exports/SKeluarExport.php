<?php

namespace App\Exports;

use App\Models\S_Keluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SKeluarExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Mengambil data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return S_Keluar::with('obat')->get(); // Mengambil data dengan relasi
    }

    /**
     * Menentukan heading kolom.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Kode Obat Keluar',
            'Tanggal Keluar',
            'Nama Obat',
            'Qty',
        ];
    }

    /**
     * Memetakan data dari model ke format yang diekspor.
     *
     * @param $skeluar
     * @return array
     */
    public function map($skeluar): array
    {
        return [
            $skeluar->kode_obat_keluar,
            $skeluar->tanggal_keluar,
            $skeluar->obat->nama_obat,
            $skeluar->qty,
        ];
    }
}
