<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveType;
class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Annual Leave',
                'name_kh' => 'ឈប់សម្រាកប្រចាំឆ្នាំ',
                'allowed' => 'all',
                'counting_days' => 18
            ],
            [
                'name' => 'Sick Leave',
                'name_kh' => 'ឈប់សម្រាកឈឺ',
                'allowed' => 'all',
                'counting_days' => 7,
            ],
            [
                'name' => 'Maternity Leave',
                'name_kh' => 'ឈប់សម្រាកសម្រាលកូន',
                'allowed' => 'female',
                'counting_days' => 90,
            ],
        ];

        foreach ($data as $item) {
            LeaveType::updateOrCreate(
                ['name' => $item['name']], // prevent duplicates
                $item
            );
        }
        //
    }
}
