<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function __invoke($city)
    {
        $coordinates = config('frontend.cities.'.$city);
        return Cache::remember('city' . $city, 60 * 5, function() use ($coordinates) {
            $response = Http::get('https://api.open-meteo.com/v1/forecast?latitude=' . $coordinates['lat'] . '&longitude=' . $coordinates['lng'] . '&daily=temperature_2m_max,temperature_2m_min&timezone=' . config('app.timezone'));
            if ($response->successful()) {
                return $response->json('daily');
            }

            return response()->json([]);
        });
    }
}