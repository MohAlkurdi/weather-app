<?php

namespace Tests\Unit;

use App\Http\Controllers\WeatherController;
use Illuminate\Http\Request;
use Tests\TestCase;

class GetWeatherDataForMultipleCitiesTest extends TestCase
{
    /**
     * Test getting weather data for multiple cities.
     */
    public function testGetWeatherDataForMultipleCities(): void
    {
        // Mocking the request object with input data
        $request = new Request([
            'cities' => ['New York', 'London'],
        ]);

        // Create an instance of the WeatherController
        $weatherController = new WeatherController();

        // Call the method being tested
        $weatherData = $weatherController->getWeatherDataForMultipleCities($request);

        // Assert that the response is an array
        $this->assertIsArray($weatherData);

        // Assert that the response contains data for each city
        $this->assertCount(2, $weatherData);

        foreach ($weatherData as $cityWeather) {
            $this->assertArrayHasKey('location', $cityWeather);
            $this->assertArrayHasKey('current', $cityWeather);
        }
    }
}
