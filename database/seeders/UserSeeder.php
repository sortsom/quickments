<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Owner User
        $owner = User::updateOrCreate(
            ['email' => 'owner@gmail.com'], // check unique
            [
                'name' => 'Owner User',
                'password' => Hash::make('12345678'),
            ]
        );

        Roles::updateOrCreate(
            ['user_id' => $owner->id],
            ['role' => 'owner']
        );

        // Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'),
            ]
        );

        Roles::updateOrCreate(
            ['user_id' => $admin->id],
            ['role' => 'admin']
        );

        // Staff User
        $staff = User::updateOrCreate(
            ['email' => 'staff@gmail.com'],
            [
                'name' => 'Staff User',
                'password' => Hash::make('12345678'),
            ]
        );

        Roles::updateOrCreate(
            ['user_id' => $staff->id],
            ['role' => 'staff']
        );
    }
}
