<?php

namespace App\Http\Controllers;

use App\Models\mdlConsumirExterno;
use Illuminate\Http\Request;

class ctlConsumirExterno extends Controller
{
    public function index()
    {
        // Obtenemos los datos a través del modelo
        $datos = mdlConsumirExterno::obtenerDatos();

        // Los pasamos a la vista
        return view('consumir_externo', compact('datos'));
    }
}
