<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'moin69603@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('Admin123Password'),
                'role' => 'admin',
            ]
        );
    }
}
