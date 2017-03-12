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
        	'name' => 'Especie 1',
            'photo' => 'jpg',
        ]);

        Species::create([
        	'name' => 'Especie 2',
            'photo' => 'jpg',
        ]);
    }
}
