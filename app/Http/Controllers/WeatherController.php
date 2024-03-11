<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * get weather data
     *
     * Get Weather Data
     */
    public function getWeatherDataByCityName(string $city): mixed
    {
        // Check if weather data for the specified city is available in the cache
        if (Cache::has('weather_'.$city)) {
            // If cached data is available, return it
            return Cache::get('weather_'.$city);
        } else {
            // If not available in cache, fetch weather data from the API
            $response = Http::get('http://api.weatherapi.com/v1/current.json?key='.env('WEATHER_API_KEY').'&q='.$city.'&aqi=no');

            // Store fetched data in the cache for future use
            Cache::put('weather_'.$city, $response->json(), now()->addHours(1));

            // Return the fetched data
            return $response->json();
        }
    }
}
