<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftLimitsTableSeeder extends Seeder
{
    public function run()
    {
        $filename = file_get_contents(base_path().'/database/seeders/sqlFiles/shiftLimits.sql');
        DB::unprepared($filename);
    }
}