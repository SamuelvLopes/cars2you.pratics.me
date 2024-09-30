<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\Category;
use App\Models\VehicleModel;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        return [
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'model_id' => VehicleModel::inRandomOrder()->first()->id,
            'status_id' => Status::inRandomOrder()->first()->id,
            'status_id' => Color::inRandomOrder()->first()->id,
            'manufacture_year' => $this->faker->year,
            'weight' => $this->faker->randomFloat(2, 1000, 5000),
        ];
    }
}
