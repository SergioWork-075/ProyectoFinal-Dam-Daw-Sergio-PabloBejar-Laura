<?php

namespace App\Http\Controllers;
use App\Models\Noticia;
use App\Models\Partida;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
   /* public function index()
    {
        //Obtengo las noticias a mostrar en la home
        $rowset = Noticia::where('activo', 1)->where('home', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.index',[
            'rowset' => $rowset,
        ]);
    }*/
    public function index()
    {
        //Obtengo las noticias a mostrar en la home
        $rowset = Partida::orderBy('tiempo', 'ASC')->get();

      /*  $usuarioJoin =DB::table('partidas')
            ->join('usuarios', 'usuarios.nombre', '=', 'partidas.usuario')
            ->select('partidas.usuario')
            ->get();*/

        $imagenJoin =Partida::select('usuarios.imagen')->
            join('usuarios', 'usuarios.email', '=', 'partidas.usuario')
            ->get();
        foreach ($imagenJoin as $imagen){
            echo $imagen->imagen;

        }
        return view('app.index',[
            'rowset' => $rowset,
            //'usuarioJoin' => $usuarioJoin,
            'imagenJoin' => $imagenJoin
        ]);
    }

    public function noticias()
    {
        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Noticia::where('activo', 1)->orderBy('fecha', 'DESC')->get();

        return view('app.noticias',[
            'rowset' => $rowset,
        ]);
    }

    public function noticia($slug)
    {
        //Obtengo la noticia o muestro error
        $row = Noticia::where('activo', 1)->where('slug', $slug)->firstOrFail();

        return view('app.noticia',[
            'row' => $row,
        ]);
    }
    public function partidas()
    {
        //Obtengo las noticias a mostrar en el listado de noticias
        $rowset = Partida::orderBy('tiempo', 'ASC')->get();

        return view('app.partidas',[
            'rowset' => $rowset,
        ]);
    }

    public function partida($slug)
    {
        //Obtengo la noticia o muestro error
        $row = Partida::where('slug', $slug)->firstOrFail();

        return view('app.partida',[
            'row' => $row,
        ]);
    }
    public function acercade()
    {
        return view('app.acerca-de');
    }
}
