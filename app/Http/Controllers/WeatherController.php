<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * get weather data
     *
     * Get Weather Data
     *
     * @param  string  $city  The name of the city for which weather data should be retrieved.
     * @return mixed The weather data for the specified city.
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

    /**
     * Get weather data for multiple cities.
     *
     * Returns the current weather data for multiple cities in a single request.
     *
     * @return array An array of weather data objects for each city.
     */
    public function getWeatherDataForMultipleCities(Request $request): array
    {
        // Retrieve the array of city names from the request
        $cities = $request->input('cities', []);

        $weatherData = [];

        // Fetch weather data for each city
        foreach ($cities as $city) {
            // Fetch weather data from the API
            $response = Http::get('http://api.weatherapi.com/v1/current.json?key='.env('WEATHER_API_KEY').'&q='.$city.'&aqi=no');

            // Add weather data to the response array
            $weatherData[] = $response->json();
        }

        return $weatherData;
    }

    /**
     * Get weather statistics
     *
     * Get weather statistics
     *
     * @param  string  $city  The name of the city for which weather statistics should be retrieved.
     */
    public function getWeatherStatistics(string $city): JsonResponse
    {

        $response = Http::get('http://api.weatherapi.com/v1/forecast.json?key='.env('WEATHER_API_KEY').'&q='.$city.'&aqi=no&alerts=no');

        $data = json_decode($response->body(), true);

        $response = response()->json([
            'max_temp' => $data['forecast']['forecastday'][0]['day']['maxtemp_c'],
            'min_temp' => $data['forecast']['forecastday'][0]['day']['mintemp_c'],
            'avg_temp' => $data['forecast']['forecastday'][0]['day']['avgtemp_c'],
            'condition' => $data['forecast']['forecastday'][0]['day']['condition']['text'],
        ]);

        return $response;
    }
}
