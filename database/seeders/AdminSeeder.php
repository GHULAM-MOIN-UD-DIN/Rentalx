<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'moin69603@gmail.com',
            'password' => bcrypt('Admin123Password'),
            'role' => 'admin',
        ]);
    }
}
