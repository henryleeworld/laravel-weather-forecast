<?php

use App\Http\Integrations\OpenMeteo\WeatherConnector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
Route::get('weather/{city}', WeatherConnector::class);
