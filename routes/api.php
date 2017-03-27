<?php

use Illuminate\Http\Request;

Route::get('/diseases', 'Api\DiseaseController@all');

Route::get('/user', function (Request $request) {
    return $request->user();
});
