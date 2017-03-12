<?php

use Illuminate\Database\Seeder;
use App\Symptom;
class SymptomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Symptom::create([
        	'name' => 'Sintoma 1',
        ]);

        Symptom::create([
        	'name' => 'Sintoma 2',
        ]);

        Symptom::create([
        	'name' => 'Sintoma 3',
        ]);

        Symptom::create([
        	'name' => 'Sintoma 4',
        ]);

        Symptom::create([
        	'name' => 'Sintoma 5',
        ]);

        Symptom::create([
        	'name' => 'Sintoma 6',
        ]);
    }
}
