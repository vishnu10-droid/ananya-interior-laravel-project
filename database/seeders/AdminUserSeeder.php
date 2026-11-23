<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Vikas Bansal', 'email' => 'admin@ananyaagra.com', 'role' => 'admin'],
            ['name' => 'Studio Manager', 'email' => 'studio@ananyaagra.com', 'role' => 'editor'],
            ['name' => 'Site Coordinator', 'email' => 'site@ananyaagra.com', 'role' => 'viewer'],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'password' => Hash::make(env('ADMIN_SEED_PASSWORD', 'password')),
                    'phone' => '+91 7351400063',
                    'active' => true,
                ]
            );
        }
    }
}
