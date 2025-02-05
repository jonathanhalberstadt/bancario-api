<?php

namespace Database\Factories;

use App\Models\Conta;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContaFactory extends Factory
{
    protected $model = Conta::class;

    public function definition()
    {
        return [
            'numero_conta' => $this->faker->unique()->randomNumber(6),
            'saldo' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
