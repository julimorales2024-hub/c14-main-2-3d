<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoleculesTableSeeder extends Seeder
{
    public function run()
    {
        $filename = file_get_contents(base_path().'/database/seeders/sqlFiles/molecules.sql');
        DB::unprepared($filename);
    }
}