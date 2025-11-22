<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // Insert into attendances
        DB::table('attendances')->insert([
            [
                'id' => 1,
                'member_id' => 1,
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'start_time2' => '14:00:00',
                'end_time2' => '17:30:00',
                'date' => '2025-11-21',
                'status' => '1',
                'half_time' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'member_id' => 1,
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'start_time2' => '14:00:00',
                'end_time2' => '17:30:00',
                'date' => '2025-11-22',
                'status' => '1',
                'half_time' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // Insert into attendance_details
        DB::table('attendance_details')->insert([
            [
                'id' => 1,
                'attendance_id' => 1,
                'clock' => '07:03:36',
                'check_type' => 1,
                'status' => 'Good',
                'reason' => null,
                'count_time' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'attendance_id' => 1,
                'clock' => '12:00:00',
                'check_type' => 2,
                'status' => 'Good',
                'reason' => null,
                'count_time' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'attendance_id' => 1,
                'clock' => '14:06:13',
                'check_type' => 3,
                'status' => 'Late',
                'reason' => 'OK',
                'count_time' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'attendance_id' => 1,
                'clock' => '17:15:39',
                'check_type' => 4,
                'status' => 'Early',
                'reason' => 'OK',
                'count_time' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'attendance_id' => 2,
                'clock' => '07:03:36',
                'check_type' => 1,
                'status' => 'Good',
                'reason' => null,
                'count_time' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'attendance_id' => 2,
                'clock' => '12:00:00',
                'check_type' => 2,
                'status' => 'Good',
                'reason' => null,
                'count_time' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}