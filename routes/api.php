<?php

use App\Http\Integrations\OpenMeteo\WeatherConnector;
use Illuminate\Support\Facades\Route;

Route::get('weather/{city}', WeatherConnector::class);
