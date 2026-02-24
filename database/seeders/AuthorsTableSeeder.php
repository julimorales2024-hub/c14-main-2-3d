<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsTableSeeder extends Seeder
{
    public function run()
    {
        $filename = file_get_contents(base_path().'/database/seeders/sqlFiles/authors.sql');
        DB::unprepared($filename);
    }
}