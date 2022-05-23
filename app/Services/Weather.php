<?php

namespace App\Services;

class Weather
{
    public static function getCurrentWeather()
    {
        //Bucharest
        $lat = '44.43';
        $lon = '26.09';

        $api_key = 'a1bbdb2bf4e45b0e912af819ae68e44d';
        $url = 'https://api.openweathermap.org/data/2.5/weather?lat='.$lat.'&lon='.$lon .'&units=metric&appid='.$api_key;

        $weather_data = json_decode( file_get_contents($url), true);

        $weather = $weather_data['weather']['0']['main'];
        $temp = $weather_data['main']['temp'];
        $wind = $weather_data['wind']['speed'];

        return['temp' => $temp, 'weather' => $weather, 'wind' => $wind];
    }

}
