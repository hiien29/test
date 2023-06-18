<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
        [
            'number'=>'001',
            'name' => '部署A',
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'number'=>'002',
            'name' => '部署B',
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);
    }
}
