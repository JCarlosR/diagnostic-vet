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
        	'name' => 'DEBILIDAD',
        ]);

        Symptom::create([
        	'name' => 'DIARREA',
        ]);
    }
}
