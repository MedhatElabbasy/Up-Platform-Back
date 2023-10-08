<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::createOrFirst([
            'name' => 'Super Admin',
            'email' => 'super_admin@example.com',
            'email_verified_at' => now(),
            'phone' => '99999999999',
            'password' => 'password'
        ]);

        $user->assignRole('Super Admin');
    }
}
