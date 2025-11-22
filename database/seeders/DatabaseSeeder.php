<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        UserSeeder::class,
        UserSeeder::class,
        WeeklySeeder::class,
        MemberSeeder::class,
        StatusSeeder::class,
        AttendanceSeeder::class,
        WorktimeSeeder::class,
    ]);
    }
}