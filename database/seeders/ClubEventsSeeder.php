<?php

namespace Database\Seeders;

use App\Models\ClubEvent;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClubEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClubEvent::factory(10)->create();
    }
}