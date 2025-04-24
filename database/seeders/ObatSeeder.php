<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obats = [
            ['nama_obat' => 'ACIFAR 5% CREAM 5 G', 'jenis' => 'Salep'],
            ['nama_obat' => 'BIOPLACENTON GEL 15 G', 'jenis' => 'Salep'],
            ['nama_obat' => 'ERPHAMAZOL 1% KRIM 5 G', 'jenis' => 'Salep'],
            ['nama_obat' => 'Erladerm-N Krim 5 g', 'jenis' => 'Salep'],
            ['nama_obat' => 'MOLAKRIM CREAM 30 G', 'jenis' => 'Salep'],
            ['nama_obat' => 'NISAGON CREAM 5 G', 'jenis' => 'Salep'],
            ['nama_obat' => 'NESTACORT 2.5% CREAM 5 GR', 'jenis' => 'Salep'],
            ['nama_obat' => 'SCABIMITE 5% CREAM 30 G', 'jenis' => 'Salep'],
            ['nama_obat' => 'BUFACOMB', 'jenis' => 'Salep'],
            ['nama_obat' => 'GENOINT', 'jenis' => 'Salep'],
            ['nama_obat' => 'LACIVIR', 'jenis' => 'Salep'],
            ['nama_obat' => 'KETOCONAZOL', 'jenis' => 'Salep'],
            ['nama_obat' => 'Bufagan expectorant sirup 60 ml', 'jenis' => 'Syrup'],
            ['nama_obat' => 'COLFIN SIRUP 60 ML', 'jenis' => 'Syrup'],
            ['nama_obat' => 'DIONICOL SIRUP 60 ML', 'jenis' => 'Syrup'],
            ['nama_obat' => 'ERYRA SIRUP 60 ML', 'jenis' => 'Syrup'],
            ['nama_obat' => 'ERPHAKAP PLUS 60ML', 'jenis' => 'Syrup'],
            ['nama_obat' => 'FARSIFEN SUSPENSI 60 ML', 'jenis' => 'Syrup'],
            ['nama_obat' => 'FARSIFEN SYR 60ML', 'jenis' => 'Syrup'],
            ['nama_obat' => 'Flutop-C Sirup 60 ml', 'jenis' => 'Syrup'],
        ];

        foreach ($obats as $index => $obat) {
            $jenis_id = DB::table('jenis')->where('nama_jenis', $obat['jenis'])->value('id');
            
            // Generate kode_obat format KH-00001, KH-00002, ...
            $kode_obat = 'KH-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT);
            
            DB::table('obats')->insert([
                'kode_obat' => $kode_obat,
                'nama_obat' => $obat['nama_obat'],
                'stok' => 0,
                'jenis_id' => $jenis_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
