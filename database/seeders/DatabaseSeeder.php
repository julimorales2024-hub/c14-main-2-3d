<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(AtomicWeightsTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(BibliographiesTableSeeder::class);
        $this->call(MoleculesTableSeeder::class);
        $this->call(CarbonsTableSeeder::class);
        $this->call(ShiftLimitsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}