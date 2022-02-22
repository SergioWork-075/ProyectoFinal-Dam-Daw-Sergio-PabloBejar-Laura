<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Partida;
use App\Http\Requests\PartidaRequest;

class PartidaController extends Controller
{
    public function __construct()
    {
        /**
         * Asigno el middleware auth al controlador,
         * de modo que sea necesario estar al menos autenticado
         */
        $this->middleware('auth');
    }
    /**
     * Mostrar un listado de elementos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtengo las noticias a mostrar en la home
        $rowset = Partida::orderBy('tiempo', 'ASC')
            ->join('usuarios', 'usuarios.email', '=', 'partidas.usuario')
            ->get();
        return view('admin.partidas.index',[
            'rowset' => $rowset,
        ]);
    }

    public function misPartidas($slug)
    {
        //Obtengo la Partida o muestro error
        $rowset = Partida::orderBy('tiempo', 'ASC')->firstOrFail()
            ->join('usuarios', 'usuarios.email', '=', 'partidas.usuario')
            ->where('usuarios.slug' ,$slug)
            ->get();
        return view('admin.partidas.misPartidas',[
            'rowset' => $rowset,
        ]);
    }
    /**
     * Mostrar el formulario para crear un nuevo elemento
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        //Creo un nuevo usuario vacío
        $row = new Partida();
        $row = new Partida();

        return view('admin.partidas.editar',[
            'row' => $row,
        ]);
    }
    /**
     * Guardar un nuevo elemento en la bbdd
     *
     * @param  \App\Http\Requests\PartidaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(PartidaRequest $request)
    {
        $row = Partida::create([
            'usuario' => $request->usuario,
            'slug' => $this->getSlug($request->usuario),
            'puntos' => $request->puntos,
            'tiempo' => $request->tiempo,
            'fecha' => \DateTime::createFromFormat("d-m-Y", $request->fecha)->format("Y-m-d H:i:s"),
            'activo' => $request->activo
        ]);
        //Imagen
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombre = $archivo->getClientOriginalName();
            $archivo->move(public_path()."/img/", $nombre);
            Partida::where('id', $row->id)->update(['imagen' => $nombre]);
            $texto = " e imagen subida.";
        }
        else{
            $texto = ".";
        }
        return redirect('admin/partidas')->with('success', 'Partida <strong>'.$request->usuario.'</strong> creada'.$texto);
    }

    /**
     * Mostrar el formulario para editar un elemento
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        //Obtengo la Partida o muestro error
        $row = Partida::where('id', $id)->firstOrFail();
        return view('admin.partidas.editar',[
            'row' => $row,
        ]);
    }

    /**
     * Actualizar un elemento en la bbdd
     *
     * @param  \App\Http\Requests\PartidaRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(PartidaRequest $request, $id)
    {
        $row = Partida::findOrFail($id);

        Partida::where('id', $row->id)->update([
            'usuario' => $request->titulo,
            'slug' => $this->getSlug($request->titulo),
            'puntos' => $request->puntos,
            'tiempo' => $request->tiempo,
            'fecha' => \DateTime::createFromFormat("d-m-Y", $request->fecha)->format("Y-m-d H:i:s"),
            'activo' => $request->activo
        ]);

        //Imagen
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombre = $archivo->getClientOriginalName();
            $archivo->move(public_path()."/img/", $nombre);
            Partida::where('id', $row->id)->update(['imagen' => $nombre]);
            $texto = " e imagen subida.";
        }
        else{
            $texto = ".";
        }
        return redirect('admin/partidas')->with('success', 'Partida <strong>'.$request->titulo.'</strong> guardada'.$texto);
    }
    /**
     * Activar o desactivar elemento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activar($id)
    {
        $row = Partida::findOrFail($id);
        $valor = ($row->activo) ? 0 : 1;
        $texto = ($row->activo) ? "desactivada" : "activada";
        Partida::where('id', $row->id)->update(['activo' => $valor]);
        return redirect('admin/partidas')->with('success', 'Partida <strong>'.$row->usuario.'</strong> '.$texto.'.');
    }
    /**
     * Borrar elemento (e imagen asociada si existe).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar($id)
    {
        $row = Partida::findOrFail($id);
        Partida::destroy($row->id);
        return redirect('admin/partidas')->with('success', 'Partida <strong>'.$row->usuario.'</strong> borrada Correctamente.');
    }
    //Función para generar el slug a partir de un string
    public function getSlug($str){
        //Quito acentos y caracteres extraños
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë',
            'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø',
            'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å',
            'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò',
            'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā',
            'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č',
            'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę',
            'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ',
            'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ',
            'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ',
            'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ',
            'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ',
            'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ',
            'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů',
            'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż',
            'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ',
            'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ',
            'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E',
            'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O',
            'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a',
            'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o',
            'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A',
            'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C',
            'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E',
            'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H',
            'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I',
            'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L',
            'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n',
            'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r',
            'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't',
            'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u',
            'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z',
            'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I',
            'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U',
            'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        $sin_acentos = str_replace($a, $b, $str);
        //genero slug
        return mb_strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'), array('', '-', ''), $sin_acentos),'UTF-8');
    }
}
