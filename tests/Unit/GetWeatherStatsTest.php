<?php

namespace Tests\Unit;

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GetWeatherStatsTest extends TestCase
{
    /**
     * @return void @test
     */
    public function it_returns_weather_statistics_for_given_city(): void
    {
        // Mock the HTTP response
        Http::fake([
            'api.weatherapi.com/v1/forecast.json*' => Http::response([
                'forecast' => [
                    'forecastday' => [
                        [
                            'day' => [
                                'maxtemp_c' => 20,
                                'mintemp_c' => 10,
                                'avgtemp_c' => 15,
                                'condition' => [
                                    'text' => 'Sunny',
                                ],
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        // Create an instance of WeatherService
        $weatherService = new WeatherController();

        // Call the method with a city name
        $response = $weatherService->getWeatherStatistics('London');

        // Decode the JSON response into an array
        $responseData = $response->getData(true);

        // Assertions
        $this->assertEquals(20, $responseData['max_temp']);
        $this->assertEquals(10, $responseData['min_temp']);
        $this->assertEquals(15, $responseData['avg_temp']);
        $this->assertEquals('Sunny', $responseData['condition']);
    }
}
