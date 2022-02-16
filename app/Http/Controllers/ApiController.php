<?php

namespace App\Http\Controllers;
use App\Models\Partida;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

//Métodos para la API (podrían ir en otro controlador)
    public function mostrar(){

        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Partida::orderBy('tiempo', 'ASC')->get();

        //Opción rápida (datos completos)
        //$noticias = $rowset;

        //Opción personalizada
        foreach ($rowset as $row){
            $noticias[] = [
                'usuario' => $row->usuario,
                'puntos' => $row->puntos,
                'tiempo' => $row->tiempo,
                'fecha' => date("d/m/Y", strtotime($row->fecha)),
                'enlace' => url("partida/".$row->slug),
                'imagen' => asset("img/".$row->imagen)
            ];
        }

        //Devuelvo JSON
        return response()->json(
            $noticias, //Array de objetos
            200, //Tipo de respuesta
            [], //Headers
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE //Opciones de escape
        );

    }

    public function leer(){

        //Url de destino
        $url = route('mostrar');

        //Parseo datos a un array
        $rowset = json_decode(file_get_contents($url), true);

        //LLamo a la vista
        return view('api.leer',[
            'rowset' => $rowset,
        ]);

    }

    public function  registrar(){

    }
}
