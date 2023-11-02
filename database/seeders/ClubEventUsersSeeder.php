<?php

namespace Database\Seeders;

use App\Models\ClubEventUser;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClubEventUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClubEventUser::factory(10)->create();
    }
}