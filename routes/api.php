<?php

// Species and systems
Route::get('/species', 'Api\SpeciesController@all');
Route::get('/systems', 'Api\SystemController@bySpecies');

// Diseases list (all, by species and by system)
Route::get('/diseases', 'Api\DiseaseController@all');
Route::get('/system/{id}/diseases', 'Api\DiseaseController@bySystem');
Route::get('/species/{id}/diseases', 'Api\DiseaseController@bySpecies');

// Symptoms list (by species and by system)
Route::get('/system/{id}/symptoms', 'Api\SymptomController@bySystem');
Route::get('/species/{id}/symptoms', 'Api\SymptomController@bySpecies');

// Diagnosis
Route::get('/system/{id}/diagnosis', 'Api\DiagnosisController@bySystem');
Route::get('/species/{id}/diagnosis', 'Api\DiagnosisController@bySpecies');
