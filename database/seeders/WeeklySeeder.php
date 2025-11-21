<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeeklySeeder extends Seeder
{
    public function run(): void
    {
        $days = [
            ['id' => 1, 'name_kh' => 'អាទិត្យ', 'name' => 'Sunday', 'sort' => 1],
            ['id' => 2, 'name_kh' => 'ច័ន្ទ', 'name' => 'Monday', 'sort' => 2],
            ['id' => 3, 'name_kh' => 'អង្គារ', 'name' => 'Tuesday', 'sort' => 3],
            ['id' => 4, 'name_kh' => 'ពុធ', 'name' => 'Wednesday', 'sort' => 4],
            ['id' => 5, 'name_kh' => 'ព្រហស្បតិ៍', 'name' => 'Thursday', 'sort' => 5],
            ['id' => 6, 'name_kh' => 'សុក្រ', 'name' => 'Friday', 'sort' => 6],
            ['id' => 7, 'name_kh' => 'សៅរ៍', 'name' => 'Saturday', 'sort' => 7],
        ];

        foreach ($days as $day) {
            DB::table('weeklies')->updateOrInsert(
                ['id' => $day['id']],
                $day
            );
        }
    }
}
