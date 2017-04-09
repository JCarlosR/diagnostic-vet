<?php

namespace App\Http\Controllers\Api;

use App\DiseaseSymptom;
use App\DiseaseSystem;
use App\Species;
use App\Symptom;
use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SymptomController extends Controller
{
    public function bySystem($id) {
        $diseases_id = DiseaseSystem::where('system_id', $id)->pluck('disease_id');
        $symptoms_id = DiseaseSymptom::whereIn('disease_id', $diseases_id)->distinct()->pluck('symptom_id');
        $symptoms = Symptom::whereIn('id', $symptoms_id)->orderBy('name', 'asc')->get(['id', 'name']);
        return $symptoms;
    }

    public function bySpecies($id) {
        $systems_id = System::where('species_id', $id)->pluck('id');
        $diseases_id = DiseaseSystem::whereIn('system_id', $systems_id)->pluck('disease_id');
        $symptoms_id = DiseaseSymptom::whereIn('disease_id', $diseases_id)->distinct()->pluck('symptom_id');
        $symptoms = Symptom::whereIn('id', $symptoms_id)->orderBy('name', 'asc')->get(['id', 'name']);
        return $symptoms;
    }
}
