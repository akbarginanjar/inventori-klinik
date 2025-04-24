<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        // $this->call(SupplierSeeder::class);
        // $this->call(JenisSeeder::class);
        // $this->call(ObatSeeder::class);
    }
}
