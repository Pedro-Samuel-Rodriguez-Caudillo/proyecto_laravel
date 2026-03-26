<?php

namespace App\Http\Controllers;

use App\Models\mdlSumatoria;
use Illuminate\Http\Request;

class ctlBienvenido extends Controller
{
    public static function index(){
        return view('welcome');
    }

    public static function suma($n1,$n2){

        $suma = new mdlSumatoria()->sumar($n1,$n2);
        return "Resultado de la suma {$suma}";
    }

}
