<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use App\Models\Noticia;
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
        return view('app.index');
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
        //Obtengo las noticias a mostrar en la home
        $rowset =Partida::orderBy('tiempo', 'ASC')
            ->join('usuarios', 'usuarios.email', '=', 'partidas.usuario')
            ->where('partidas.activo', 1)
             ->where('usuarios.activo',1 )
            ->get();
        return view('app.partidas',[
            'rowset' => $rowset,
        ]);
    }
    public function partida($slug)
    {
        //Obtengo la noticia o muestro error
        $row = Partida::where('slug', $slug)->firstOrFail();

        $imagenJoin = Partida::

            join('usuarios', 'usuarios.email', '=', 'partidas.usuario')
               ->where('slug', $slug)
        ->get();
        return view('app.partida',[
            'row' => $row,
           'imagenJoin'=>$imagenJoin,
        ]);
    }
    public function acercade()
    {
        return view('app.acerca-de');
    }
}
