<?php

namespace Database\Factories;

use App\Models\BankUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankUserFactory extends Factory
{
    protected $model = BankUser::class;

    public function definition()
    {
        return [
            'first_name'   => $this->faker->firstName,
            'middle_name'  => $this->faker->optional()->firstName,
            'last_name'    => $this->faker->lastName,
            'occupation'   => $this->faker->jobTitle,
            'balance'      => $this->faker->randomFloat(2, 100, 5000),
        ];
    }
}
