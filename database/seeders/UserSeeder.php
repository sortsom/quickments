<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Owner User
        $owner = User::create([
            'name' => 'Owner User',
            'email' => 'owner@demo.com',
            'password' => Hash::make('12345678'),
        ]);

        Roles::create([
            'user_id' => $owner->id,
            'role' => 'owner',
        ]);

        // Admin User
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@demo.com',
            'password' => Hash::make('12345678'),
        ]);

        Roles::create([
            'user_id' => $admin->id,
            'role' => 'admin',
        ]);

        // Staff User
        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff@demo.com',
            'password' => Hash::make('12345678'),
        ]);

        Roles::create([
            'user_id' => $staff->id,
            'role' => 'staff',
        ]);
        
    }
}