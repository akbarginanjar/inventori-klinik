<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'nama_supplier' => 'Rokhmat Ginanjar',
            'no_telepon' => '081292690547',
            'alamat' => 'Bandung',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
