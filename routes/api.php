<?php

use Illuminate\Http\Request;

Route::get('/diseases', 'Api\DiseaseController@all');

Route::get('/system/{id}/diseases', 'Api\DiseaseController@bySystem');

Route::get('/species/{id}/diseases', 'Api\DiseaseController@bySpecies');
