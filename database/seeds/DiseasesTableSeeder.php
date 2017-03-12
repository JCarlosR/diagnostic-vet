<?php

use Illuminate\Database\Seeder;
use App\Disease;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disease::create([
        	'name' => 'Enfermedad 1',
        	'description' => 'Descripcion prueba 1',
        ]);

        Disease::create([
        	'name' => 'Enfermedad 2',
        	'description' => 'Descripcion prueba 2',
        ]);

        Disease::create([
        	'name' => 'Enfermedad 3',
        	'description' => 'Descripcion prueba 3',
        ]);

        Disease::create([
        	'name' => 'Enfermedad 4',
        	'description' => 'Descripcion prueba 4',
        ]);

        Disease::create([
        	'name' => 'Enfermedad 5',
        	'description' => 'Descripcion prueba 5',
        ]);

        Disease::create([
        	'name' => 'Enfermedad 6',
        	'description' => 'Descripcion prueba 6',
        ]);
    }
}
