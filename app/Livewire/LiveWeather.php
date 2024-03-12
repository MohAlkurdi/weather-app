<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

class LiveWeather extends Component
{
    #[Title('Live Weather')]
    #[Url]
    public $city = '';

    public function render()
    {
        $response = Http::get('http://api.weatherapi.com/v1/forecast.json?key='.env('WEATHER_API_KEY').'&q='.$this->city.'&aqi=no&alerts=no');

        $data = json_decode($response->body(), true);

        return view('livewire.live-weather', [
            'city' => $this->city,
            'max_temp' => $data['forecast']['forecastday'][0]['day']['maxtemp_c'],
            'min_temp' => $data['forecast']['forecastday'][0]['day']['mintemp_c'],
            'avg_temp' => $data['forecast']['forecastday'][0]['day']['avgtemp_c'],
            'condition' => $data['forecast']['forecastday'][0]['day']['condition']['text'],
        ]);
    }
}
