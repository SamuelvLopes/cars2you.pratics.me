<?php

namespace Database\Factories;

use App\Models\VehicleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleModelFactory extends Factory
{
    protected $model = VehicleModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word, 
        ];
    }
}
