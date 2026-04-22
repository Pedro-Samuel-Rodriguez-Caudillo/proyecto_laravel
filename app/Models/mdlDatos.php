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

    public static function getByName($name){
        $enlace = Http::get('https://dinosaur-facts-api.shultzlab.com/dinosaurs')->json();
        $res = array_filter($enlace, fn($item) => $item['Name'] === $name);
        return array_values($res)[0] ?? null;
    }
}
