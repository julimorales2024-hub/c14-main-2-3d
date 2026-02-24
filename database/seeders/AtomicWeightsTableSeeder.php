<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtomicWeightsTableSeeder extends Seeder
{
    public function run()
    {
        $filename = file_get_contents(base_path().'/database/seeders/sqlFiles/atomicWeights.sql');
        DB::unprepared($filename);
    }
}