<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

	//Especies
	Route::get('/especies', 'SpeciesController@index');
	Route::post('/especies', 'SpeciesController@store');

	Route::get('/especie/{id}', 'SpeciesController@edit');
	Route::post('/especie/{id}', 'SpeciesController@update');

	Route::get('/especie/{id}/eliminar', 'SpeciesController@delete');

	//Sistemas
	Route::get('/sistemas/{id}', 'SystemController@index');
	Route::post('/sistemas/{id}', 'SystemController@store');

	Route::get('/sistema/{id}', 'SystemController@edit');
	Route::post('/sistema/{id}', 'SystemController@update');

	Route::get('/sistema/{id}/eliminar', 'SystemController@delete');

	//Disease
	Route::get('/enfermedadesAll/{id_specie}', 'DiseaseController@indexAll');//aqui todas las enfermedades de la especie
	Route::get('/enfermedades/{id}', 'DiseaseController@index');//aqui enfermdedades por sistema
	Route::post('/enfermedades', 'DiseaseController@store');

	Route::get('/enfermedadAll/{species_id}/{id_disease}/editar', 'DiseaseController@editAll'); // editar todas las  enfermedades de una especie
	Route::get('/enfermedad/{id}/{id_disease}/editar', 'DiseaseController@edit'); // editar enfermedades del sistema
	// /sistema/{system_id}/enfermedad/{disease_id}/editar
	Route::post('/enfermedad/{id}', 'DiseaseController@update');

	Route::get('/enfermedad/{id}/eliminar', 'DiseaseController@delete');

	//Symptom
	Route::post('/sintomas', 'SymptomController@store');
	Route::post('/sintomas/editar', 'SymptomController@update');


	//DiseaseSymptom
	Route::post('/enfermedad-sintoma', 'DiseaseSymptomController@store');
	Route::post('/enfermedad-sintoma/eliminar', 'DiseaseSymptomController@delete');

});



