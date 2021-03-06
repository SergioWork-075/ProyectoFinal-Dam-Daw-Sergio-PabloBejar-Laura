<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Front-end
Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('noticias', [AppController::class, 'noticias'])->name('noticias');
Route::get('noticia/{slug}', [AppController::class, 'noticia'])->name('noticia');
Route::get('partidas', [AppController::class, 'partidas'])->name('partidas');
Route::get('partida/{slug}', [AppController::class, 'partida'])->name('partida');
Route::get('acerca-de', [AppController::class, 'acercade'])->name('acerca-de');

//Back-end
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/usuarios', [UsuarioController::class, 'index'])->middleware('role:usuarios');
Route::get('admin/usuarios/crear', [UsuarioController::class, 'crear'])->middleware('role:usuarios');
Route::post('admin/usuarios/guardar', [UsuarioController::class, 'guardar'])->middleware('role:usuarios');
Route::get('admin/usuarios/editar/{id}', [UsuarioController::class, 'editar'])->middleware('role:usuarios');
Route::post('admin/usuarios/actualizar/{id}', [UsuarioController::class, 'actualizar'])->middleware('role:usuarios');
Route::post('admin/usuarios/personalizar/{usuario}', [UsuarioController::class, 'personalizar']);
Route::get('admin/usuarios/activar/{id}', [UsuarioController::class, 'activar'])->middleware('role:usuarios');
Route::get('admin/usuarios/borrar/{id}', [UsuarioController::class, 'borrar'])->middleware('role:usuarios');


Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/partidas', [PartidaController::class, 'index'])->middleware('role:partidas');
Route::get('admin/partidas/misPartidas/{slug}', [PartidaController::class, 'misPartidas']);
Route::get('admin/partidas/crear', [PartidaController::class, 'crear'])->middleware('role:partidas');
Route::post('admin/partidas/guardar', [PartidaController::class, 'guardar'])->middleware('role:partidas');
Route::get('admin/partidas/editar/{id}', [PartidaController::class, 'editar'])->middleware('role:partidas');
Route::post('admin/partidas/actualizar/{id}', [PartidaController::class, 'actualizar'])->middleware('role:partidas');
Route::get('admin/partidas/activar/{id}', [PartidaController::class, 'activar'])->middleware('role:partidas');
Route::get('admin/partidas/home/{id}', [PartidaController::class, 'home'])->middleware('role:partidas');
Route::get('admin/partidas/borrar/{id}', [PartidaController::class, 'borrar'])->middleware('role:partidas');
// admin.partidas.misPartidas

//Back-end
Route::get('admin', [AdminController::class, 'index'])->name('admin');
Route::get('admin/noticias', [NoticiaController::class, 'index'])->middleware('role:noticias');
Route::get('admin/noticias/crear', [NoticiaController::class, 'crear'])->middleware('role:noticias');
Route::post('admin/noticias/guardar', [NoticiaController::class, 'guardar'])->middleware('role:noticias');
Route::get('admin/noticias/editar/{id}', [NoticiaController::class, 'editar'])->middleware('role:noticias');
Route::post('admin/noticias/actualizar/{id}', [NoticiaController::class, 'actualizar'])->middleware('role:noticias');
Route::get('admin/noticias/activar/{id}', [NoticiaController::class, 'activar'])->middleware('role:noticias');
Route::get('admin/noticias/home/{id}', [NoticiaController::class, 'home'])->middleware('role:noticias');
Route::get('admin/noticias/borrar/{id}', [NoticiaController::class, 'borrar'])->middleware('role:noticias');

//Auth
Route::get('acceder', [AuthController::class, 'acceder'])->name('acceder');
Route::post('autenticar', [AuthController::class, 'autenticar'])->name('autenticar');
Route::get('registro', [AuthController::class, 'registro'])->name('registro');
Route::post('registrarse', [AuthController::class, 'registrarse'])->name('registrarse');
Route::post('salir', [AuthController::class, 'salir'])->name('salir');

//API Partidas y usuarios
Route::get('mostrar', [ApiController::class, 'mostrar'])->name('mostrar');
Route::get('leer', [ApiController::class, 'leer'])->name('leer');
Route::get('valorUsu', [ApiController::class, 'valorUsu'])->name('valorUsu');
Route::get('valorPartida', [ApiController::class, 'valorPartida'])->name('valorPartida');
Route::get('comprobarUsuario', [ApiController::class, 'comprobarUsuario'])->name('comprobarUsuario');
Route::get('partidaInsertar', [ApiController::class, 'partidaInsertar'])->name('partidaInsertar')       ;

//Ruta por defecto (si no encuentra otra antes)
Route::any('{query}', function() { return redirect('/'); })->where('query', '.*');
