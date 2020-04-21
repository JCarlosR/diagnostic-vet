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
             'review' => 'Reseña de prueba 1',
             'exams' => 'Examenes de prueba 1',
             'treatment' => 'Tratamiento de prueba 1',
             'species_id' => '1',
         ]);
         
         Disease::create([
             'name' => 'Enfermedad 2',
             'review' => 'Reseña de prueba 2',
             'exams' => 'Examenes de prueba 2',
             'treatment' => 'Tratamiento de prueba 2',
             'species_id' => '1',
         ]);
         
         Disease::create([
             'name' => 'Enfermedad 3',
             'review' => 'Reseña de prueba 3',
             'exams' => 'Examenes de prueba 3',
             'treatment' => 'Tratamiento de prueba 3',
             'species_id' => '1',
         ]);
         
         Disease::create([
             'name' => 'Enfermedad 4',
             'review' => 'Reseña de prueba 4',
             'exams' => 'Examenes de prueba 4',
             'treatment' => 'Tratamiento de prueba 4',
             'species_id' => '2',
         ]);
         
         Disease::create([
             'name' => 'Enfermedad 5',
             'review' => 'Reseña de prueba 5',
             'exams' => 'Examenes de prueba 5',
             'treatment' => 'Tratamiento de prueba 5',
             'species_id' => '2',
         ]);        
    }
}
