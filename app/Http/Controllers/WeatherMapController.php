<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeatherMapController extends Controller
{
   
    public function findWeather($searchValue)
    {
        try {
            $weatherData = $this->fetchWeatherData($searchValue);
            $response = $this->processWeatherData($weatherData);
            return response()->json($response, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function fetchWeatherData($searchValue)
    {
        $httpClient = new Client();
        $url = env('WEATHER_API_URL') . $searchValue . env('WEATHER_API_KEY');
        $response = $httpClient->get($url);
        return json_decode($response->getBody(), true);


    if (empty($data)) {
        return "No se encontraron resultados para la búsqueda";
    }
    return $data;
    
    }

    private function processWeatherData($weatherData)
    {       
        $latitude = $weatherData['coord']['lat'];
        $longitude = $weatherData['coord']['lon'];
        $country = $weatherData['sys']['country'];
        $state = $weatherData['name'];
        $main = $weatherData['main'];

        $response = $this->createHistoric($latitude, $longitude, $country, $state, $main['humidity']);

        $data = [
            'response' => $response,
            'data' => (object)  [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'country' => $country,
                'state' => $state,
                'humidity' => $main['humidity'],
                'temp' => $main['temp'],
                'temp_min' => $main['temp_min'],
                'temp_max' => $main['temp_max']
            ]
        ];

        return response()->json($data, Response::HTTP_OK);
    }


    private function createHistoric($latitude, $longitude, $country, $name, $humidity)
    {
        try {
            $historial = new Historial();
            $historial->lat = $latitude;
            $historial->lon = $longitude;
            $historial->humidity = $humidity;
            $historial->country = $country;
            $historial->state = $name;
            $historial->save();

            return ['success' => true, 'message' => 'Historial creado exitosamente'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function findHistoric($state)
    {
        try {

            $historial = Historial::select('state','country')->where('state', $state)->orderBy('created_at', 'desc')->get();
          
            $historial->map(function($item) use($state){
                $item->info = Historial::select('id','lat','lon','humidity','created_at')->where('state',$state)->get();
                
                return $item;
            });

            $historial = $historial->unique();
            return response()->json($historial, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
