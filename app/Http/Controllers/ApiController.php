<?php

namespace App\Http\Controllers;
use App\Http\Requests\PartidaRequest;
use App\Models\Partida;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ApiController extends Controller
{

//Métodos para la API (podrían ir en otro controlador)
    public function mostrar(){
        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Partida::orderBy('puntos', 'DESC')->limit(5)->get();
        //Opción rápida (datos completos)
        //$noticias = $rowset;

        //Opción personalizada
        foreach ($rowset as $row){
            $partidas[] = [
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
            $partidas, //Array de objetos
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
    public function comprobarUsuario (Request $request) {
        //Esto se hace mediante POST
        $emailusu = $request->email;
        $password = $request->password;

        $user = Usuario::where('email', $emailusu)->first();
        if ($user && Hash::check($password, $user->password)) {
            echo "1";
        } else {
            echo "0";
        }
    }
    public function  valorUsu(){
        return view('api.registrar');
    }
    public function valorPartida(){
        return view('api.nuevaPartida');
    }
    public function partidaInsertar (Request $request) {
        //Esto se hace mediante POST
        $row = Partida::create([
            'usuario' =>$request->usuario,
          //   'slug' => $request->setSlug($request->usuario),
            'puntos' => $request->puntos,
            'tiempo' => $request->tiempo,
            'fecha' =>  date('Y-m-d', time()),
            'activo' => $request->activo
        ]);
        //Imagen
        //Check if user was created
        if (!$row)
        {
          echo"0";
        }else{
            echo"1";
        }
    }
}
