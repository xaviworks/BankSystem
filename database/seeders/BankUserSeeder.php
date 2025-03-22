<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankUser;

class BankUserSeeder extends Seeder
{
    public function run()
    {
        // Create 50 fake bank users
        BankUser::factory()->count(20)->create();
    }
}
