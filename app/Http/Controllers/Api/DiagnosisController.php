<?php

namespace App\Http\Controllers\Api;

use App\DiseaseSymptom;
use App\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiagnosisController extends Controller
{
    public function bySystem(Request $request, $id)
    {
        // possible diseases by system
        $diseases = System::find($id)->diseases;

        // match by selected symptoms
        $selected_symptoms = $request->input('symptoms[]');

        $results = collect();
        foreach ($diseases as $disease) {
            $symptoms = DiseaseSymptom::where('disease_id', $disease->id)->pluck('id');
            $intersect_count = count( array_intersect($selected_symptoms, $symptoms) );
            if ($intersect_count > 0)
                $results->push($disease);
        }

        return $results;
    }

    public function bySpecies()
    {

    }
}
