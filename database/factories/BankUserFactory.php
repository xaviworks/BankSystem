<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BankUser;

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
            'is_deleted'   => false, // Default to active users
        ];
    }
}
