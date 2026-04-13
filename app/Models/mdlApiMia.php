<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class mdlApiMia
{
    public static function getAll(): array
    {
        $respuesta = Http::get('https://holisss.mundoiti.com/');
        return $respuesta->json() ?? [];
    }
}
