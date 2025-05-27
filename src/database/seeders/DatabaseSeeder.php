<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        WeightTarget::factory()->create([
            'user_id' => $user->id,
            'target_weight' => 65.0,
        ]);

        WeightLog::factory()
        ->count(35)
        ->state([
            'user_id' => $user->id,
        ])
        ->create();
    }
}
