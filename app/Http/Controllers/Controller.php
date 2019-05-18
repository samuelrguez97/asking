<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use App\preguntas;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    // Creo un constructor para que se ejecute todas las veces que se abre una vista
    public function __construct()
    {
        // por cada vista ..
        $this->middleware(function ($request, $next) {
            
            // Si el usuario esta logueado
            if (Auth::user()) {
                
                // Selecciono las preguntas que se han enviado al usuario con estos criterios ...
                $preguntas_a_ti = preguntas::where('id_usuario', Auth::user()->id) // solo las que son para ese usuario
                    ->where('respuesta', 0) // que no hayan sido respondidas
                    ->count(); // recojo la cuenta de los datos
                
                // Si no tiene preguntas nuevas no envio nada
                if ($preguntas_a_ti > 0) {
                    // Si las tiene, envio el numero de preguntas nuevas para mostrarlo en el navbar para mayor feedback del usuario
                    view()->share('nTusPreguntas', $preguntas_a_ti);
                }
            }
            return $next($request);
        });

    }



}
