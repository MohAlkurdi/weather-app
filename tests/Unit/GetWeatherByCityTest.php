<?php

namespace Tests\Unit;

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class GetWeatherByCityTest extends TestCase
{
    public function test_get_weather_by_city_name(): void
    {
        $controller = new WeatherController();
        $response = $controller->getWeatherDataByCityName('London');
        $this->assertArrayHasKey('current', $response);
    }

    public function test_get_weather_by_city_name_from_cache(): void
    {
        $controller = new WeatherController();
        $response = $controller->getWeatherDataByCityName('London');

        // Cache the response
        Cache::put('weather_London', $response, now()->addHours(1));

        $response = $controller->getWeatherDataByCityName('London');
        $this->assertArrayHasKey('current', $response);
    }
}
