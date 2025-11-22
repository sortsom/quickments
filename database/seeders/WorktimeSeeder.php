<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorktimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('worktimes')->insert([
            [
                'member_id' => 1,
                'day' => 2,
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'start_time2' => '14:00:00',
                'end_time2' => '17:30:00',
                'half_day' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'member_id' => 1,
                'day' => 3,
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'start_time2' => '14:00:00',
                'end_time2' => '17:30:00',
                'half_day' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'member_id' => 1,
                'day' => 4,
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'start_time2' => '14:00:00',
                'end_time2' => '17:30:00',
                'half_day' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'member_id' => 1,
                'day' => 5,
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'start_time2' => '14:00:00',
                'end_time2' => '17:30:00',
                'half_day' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'member_id' => 1,
                'day' => 6,
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'start_time2' => '14:00:00',
                'end_time2' => '17:00:00',
                'half_day' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'member_id' => 1,
                'day' => 7,
                'start_time' => '07:00:00',
                'end_time' => '12:00:00',
                'start_time2' => null,
                'end_time2' => null,
                'half_day' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
