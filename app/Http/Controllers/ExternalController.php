<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
class ExternalController extends Controller
{
    public function getWeather(Request $request)
    {
        // Request de produção
        try {
            $city = $request->input('city');
            $apiHost = 'http://api.weatherstack.com/current?access_key=' . env('weatherKey') . '&query=' . urlencode($city) . '&units=m';
            $response = Http::timeout(5)->get($apiHost);
            if ($response->successful()) {
                return response()->json($response->json());
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao processar a requisição: ' . $e->getMessage(),
                'code' => $e->getCode() ?: 500,
            ], $e->getCode() ?: 500);
        }

        // mocks testes de sucesso
        // $response = [
        //     'request' => [
        //         'type' => 'City',
        //         'query' => 'Santa Maria, Brazil',
        //         'language' => 'en',
        //         'unit' => 'm',
        //     ],
        //     'location' => [
        //         'name' => 'Santa Maria',
        //         'country' => 'Brazil',
        //         'region' => 'Rio Grande do Sul',
        //         'lat' => '-29.683',
        //         'lon' => '-53.800',
        //         'timezone_id' => 'America/Sao_Paulo',
        //         'localtime' => '2024-09-19 21:18',
        //         'localtime_epoch' => 1726780680,
        //         'utc_offset' => '-3.0',
        //     ],
        //     'current' => [
        //         'observation_time' => '12:18 AM',
        //         'temperature' => 27,
        //         'weather_code' => 113,
        //         'weather_icons' => [
        //             'https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0008_clear_sky_night.png',
        //         ],
        //         'weather_descriptions' => [
        //             'Clear',
        //         ],
        //         'wind_speed' => 12,
        //         'wind_degree' => 16,
        //         'wind_dir' => 'NNE',
        //         'pressure' => 1002,
        //         'precip' => 0.5,
        //         'humidity' => 58,
        //         'cloudcover' => 0,
        //         'feelslike' => 29,
        //         'uv_index' => 1,
        //         'visibility' => 10,
        //         'is_day' => 'no',
        //     ],
        // ];

        // //  mock response de erro para limite de usuário
        // $response = [
        //     'success' => false,
        //     'error' => [
        //         'code' => 104,
        //         'type' => 'usage_limit_reached',
        //         'info' => 'Your monthly API request volume has been reached. Please upgrade your plan.'
        //     ]
        // ];
        
        // // mock response de erro para limite de usuário
        // $response = [
        //     'success' => false,
        //     'error' => [
        //         'code' => 700,
        //         'type' => 'Erro X desconhecido',
        //         'info' => 'Erro X desconhecido.'
        //     ]
        // ];
        return response()->json($response);
    }
}
