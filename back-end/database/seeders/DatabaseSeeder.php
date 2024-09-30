<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BrandSeeder::class,
            CollorSeeder::class,
            CategorySeeder::class,
            StatusSeeder::class,
            VehicleModelSeeder::class,
            VehicleSeeder::class,
        ]);
    }
}
