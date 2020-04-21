<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(SpeciesTableSeeder::class);
        // $this->call(DiseasesTableSeeder::class);
        // $this->call(SymptomsTableSeeder::class);
        // $this->call(SystemsTableSeeder::class);
    }
}
