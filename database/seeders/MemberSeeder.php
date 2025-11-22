<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- ADD THIS
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('members')->updateOrInsert(
            ['id' => 1],
            [
                'name' => 'NAT Vannak',
                'email' => 'natvannak@gmail.com',
                'name_kh' => 'ណាត វណ្ណៈ',
                'gender' => 'male',
                'dob' => '2025-11-21',
                'photo' => null,
                'position' => 'IT',
                'phone' => '071 592 3388',
                'address' => 'Siem Reap',
                'status' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
