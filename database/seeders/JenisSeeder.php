<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Alat Habis Pakai',
            'Drop',
            'Injeksi',
            'Kaplet',
            'Kapsul', 
            'Lembar',
            'Obat',
            'Sachet',
            'Salep', 
            'Syrup',
            'Tablet',
        ];

        foreach ($data as $nama_jenis) {
            DB::table('jenis')->insert([
                'nama_jenis' => $nama_jenis,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
