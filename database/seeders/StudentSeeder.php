<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('students')->truncate(); // clears table first

        DB::table('students')->insert([
            ['name' => 'Ravi Kumar',   'section' => 'A', 'age' => 20, 'date_of_birth' => '2004-05-10', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Priya Sharma', 'section' => 'B', 'age' => 21, 'date_of_birth' => '2003-08-22', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arjun Mehta',  'section' => 'A', 'age' => 19, 'date_of_birth' => '2005-01-15', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
