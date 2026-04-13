<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class mdlConsumirExterno
{
    public static function obtenerDatos()
    {
        $url = 'https://pedro-samuel-rodriguez-caudillo-laravel.onrender.com/apiDatos';
        
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return [
            'error' => 'No se pudo conectar con el servicio externo',
            'status' => $response->status()
        ];
    }
}
