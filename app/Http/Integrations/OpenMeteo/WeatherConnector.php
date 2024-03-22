<?php

namespace App\Http\Integrations\OpenMeteo;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

final readonly class WeatherConnector
{
    public function __invoke(string $city): mixed
    {
        $coordinates = config('weather.cities.'.$city);

        return Cache::remember('city' . $city, 60 * 5, function() use ($coordinates) {
            $response = Http::get('https://api.open-meteo.com/v1/forecast?latitude='.$coordinates['lat'].'&longitude='.$coordinates['lng'].'&daily=temperature_2m_max,temperature_2m_min&timezone=UTC');

            if ($response->successful()) {
                return $response->json('daily');
            }

            return response()->json([]);
        });
    }
}
