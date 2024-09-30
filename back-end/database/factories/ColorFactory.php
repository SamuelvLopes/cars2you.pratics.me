<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->safeColorName, // Gera nomes de cores fictícias
        ];
    }
}
