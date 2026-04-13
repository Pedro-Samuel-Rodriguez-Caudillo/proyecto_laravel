<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class mdlDatos
{
    public static function getAll(): array
    {
        $enlace = Http::get('https://dinosaur-facts-api.shultzlab.com/dinosaurs');
        return $enlace->json() ?? [];
    }
}
