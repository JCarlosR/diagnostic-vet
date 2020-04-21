<?php

use Illuminate\Database\Seeder;
use App\Species;
class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Species::create([
             'name' => 'Canino',
             'photo' => 'jpg',
         ]);

         Species::create([
             'name' => 'Bovino',
             'photo' => 'jpg',
         ]);
    }
}
