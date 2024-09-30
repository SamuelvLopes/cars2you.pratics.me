<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BrandSeeder::class,
            ColorSeeder::class,
            CategorySeeder::class,
            StatusSeeder::class,
            VehicleModelSeeder::class,
            VehicleSeeder::class,
        ]);
    }
}
