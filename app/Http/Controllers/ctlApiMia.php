<?php

namespace App\Http\Controllers;

use App\Models\mdlApiMia;

class ctlApiMia extends Controller
{
    public function index()
    {
        $enlace = mdlApiMia::getAll();
        return view('apiMia', compact('enlace'));
    }
}
