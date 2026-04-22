<?php

namespace App\Http\Controllers;

use App\Models\mdlDatos;

class ctlDatos extends Controller
{
    public function index()
    {
        $enlace = mdlDatos::getAll();
        return view('datos', compact('enlace'));
    }

    public function detalle(string $n1)
    {
        $enlace = mdlDatos::getByName($n1);
        return view('vista_detalle', compact('n1', 'enlace'));

    }
}
