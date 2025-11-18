<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class weekly extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $days = [
            [
                'id' => 1,
                'name_kh' => 'អាទិត្យ',
                'name_en' => 'Sunday',
                'sort' => 1
            ],
            [
                'id' => 2,
                'name_kh' => 'ច័ន្ទ',
                'name_en' => 'Monday',
                'sort' => 2
            ],
            [
                'id' => 3,
                'name_kh' => 'អង្គារ',
                'name_en' => 'Tuesday',
                'sort' => 3
            ],
            [
                'id' => 4,
                'name_kh' => 'ពុធ',
                'name_en' => 'Wednesday',
                'sort' => 4
            ],
            [
                'id' => 5,
                'name_kh' => 'ព្រហស្បតិ៍',
                'name_en' => 'Thursday',
                'sort' => 5
            ],
            [
                'id' => 6,
                'name_kh' => 'សុក្រ',
                'name_en' => 'Friday',
                'sort' => 6
            ],
            [
                'id' => 7,
                'name_kh' => 'សៅរ៍',
                'name_en' => 'Saturday',
                'sort' => 7
            ],
        ];

        DB::table('weeklies')->insert($days);
    }
}
