<?php

namespace App\Http\Controllers;

use App\Models\mdlConsumirExterno;
use Illuminate\Http\Request;

class ctlConsumirExterno extends Controller
{
    public function index()
    {

        $datos = mdlConsumirExterno::obtenerDatos();


        return view('consumir_externo', compact('datos'));
    }
}
