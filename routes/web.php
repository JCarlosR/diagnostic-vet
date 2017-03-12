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
    return view('/auth/login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

	//Especies
	Route::get('/especies', 'SpeciesController@index');
	Route::post('/especies', 'SpeciesController@store');

	Route::get('/especie/{id}', 'SpeciesController@edit');
	Route::post('/especie/{id}', 'SpeciesController@update');

	//Sistemas
	Route::get('/sistemas/{id}', 'SystemController@index');
	Route::post('/sistemas/{id}', 'SystemController@store');



	//Disease
	Route::get('/enfermedades', 'DiseaseController@index');
	Route::post('/enfermedades', 'DiseaseController@store');

	Route::get('/enfermedad/{id}', 'DiseaseController@edit');
	Route::post('/enfermedad/{id}', 'DiseaseController@update');

	Route::get('/enfermedad/{id}/restaurar', 'DiseaseController@restore');
	Route::get('/enfermedad/{id}/eliminar', 'DiseaseController@delete');

	//Symptom
	Route::post('/sintomas', 'SymptomController@store');
	Route::post('/sintomas/editar', 'SymptomController@update');


	//DiseaseSymptom
	Route::post('/enfermedad-sintoma', 'DiseaseSymptomController@store');
	Route::post('/enfermedad-sintoma/eliminar', 'DiseaseSymptomController@delete');

});



