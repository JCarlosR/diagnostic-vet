<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	// Species
	Route::get('/especies', 'SpeciesController@index');
	Route::post('/especies', 'SpeciesController@store');
	Route::get('/especie/{id}', 'SpeciesController@edit');
	Route::post('/especie/{id}', 'SpeciesController@update');
	Route::get('/especie/{id}/eliminar', 'SpeciesController@delete');

	// Systems
	Route::get('/sistemas/{id}', 'SystemController@index');
	Route::post('/sistemas/{id}', 'SystemController@store');
	Route::get('/sistema/{id}', 'SystemController@edit');
	Route::post('/sistema/{id}', 'SystemController@update');
	Route::get('/sistema/{id}/eliminar', 'SystemController@delete');

	// Diseases
	Route::get('/enfermedadesAll/{species}', 'DiseaseController@indexAll');
	Route::get('/enfermedades/{system}', 'DiseaseController@index');
	Route::post('/enfermedades', 'DiseaseController@store');

	Route::get('/enfermedadAll/{species}/{disease}/editar', 'DiseaseController@editAll');
	Route::get('/enfermedad/{system}/{disease}/editar', 'DiseaseController@edit');
	Route::post('/enfermedad/{id}', 'DiseaseController@update');

	Route::get('/enfermedad/{id}/eliminar', 'DiseaseController@delete');

	// Symptoms
	Route::post('/sintomas', 'SymptomController@store');
	Route::post('/sintomas/editar', 'SymptomController@update');

	// DiseaseSymptom
	Route::post('/enfermedad-sintoma', 'DiseaseSymptomController@store');
	Route::post('/enfermedad-sintoma/eliminar', 'DiseaseSymptomController@delete');

});



