<?php

namespace Database\Seeders;

use App\Models\VehicleModel;
use Illuminate\Database\Seeder;

class VehicleModelSeeder extends Seeder
{
    public function run()
    {
        VehicleModel::factory(25)->create();
    }
}
