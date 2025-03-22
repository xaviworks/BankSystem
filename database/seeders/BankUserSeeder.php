<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BankUser;

class BankUserSeeder extends Seeder
{
    public function run()
    {
        // Create 10 active users
        BankUser::factory(20)->create();

        // Create 5 soft-deleted users
        BankUser::factory(0)->create(['is_deleted' => true]);
    }
}
