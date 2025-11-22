<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['id' => 1, 'name' => 'Present', 'name_kh' => 'វត្តមាន', 'sort' => 1],
            ['id' => 2, 'name' => 'Permission', 'name_kh' => 'ច្បាប់', 'sort' => 2],
            ['id' => 3, 'name' => 'Permission Morning', 'name_kh' => 'ច្បាប់ពេលព្រឹក', 'sort' => 3],
            ['id' => 4, 'name' => 'Permission Afternoon', 'name_kh' => 'ច្បាប់ពេលរសៀល', 'sort' => 4],
            ['id' => 5, 'name' => 'Absent', 'name_kh' => 'អវត្តមាន', 'sort' => 5],
            ['id' => 6, 'name' => 'Day Off', 'name_kh' => 'ឈប់សម្រាក', 'sort' => 6],
            ['id' => 7, 'name' => 'Pending', 'name_kh' => 'កំពុងរងចាំ', 'sort' => 1],
            ['id' => 8, 'name' => 'Reject', 'name_kh' => 'បដិសេដ', 'sort' => 2],
            ['id' => 9, 'name' => 'Approve', 'name_kh' => 'អនុញ្ញាត', 'sort' => 3],
            ['id' => 10, 'name' => 'Cancel', 'name_kh' => 'បោះបង់សំណើសុំច្បាប់', 'sort' => 4],
        ];

        foreach ($statuses as $status) {
            DB::table('statuses')->updateOrInsert(
                ['id' => $status['id']], // check unique by id
                $status
            );
        }
    }
}
