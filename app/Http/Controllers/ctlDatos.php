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
}
