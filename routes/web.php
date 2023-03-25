<?php

use App\Http\Controllers\AmigoController;
use App\Http\Controllers\BuscarController;
use App\Http\Controllers\ComunidadController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\MensajesController;
use App\Http\Controllers\NotificacionesController;
use App\Http\Controllers\NotificacionMensajeController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\SolicitudAmistadController;
use Illuminate\Support\Facades\Route;

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

Route::get('/red-social', function () {
    return view('index');
})->name('index');

/**Comunidad - muestra los perfiles de los usuario que se han unido a la red social*/
Route::get('/red-social/comunidad',[ComunidadController::class,'index'])->name('comunidad.index')->middleware('auth');
Route::get('red-social/perfil/{perfil}',[ComunidadController::class,'show'])->name('comunidad.show')->middleware('auth','show.perfil');

/**Mi perfil*/
Route::get('/red-social/mi-perfil/{perfil}',[PerfilController::class,'show'])->name('perfil.show')->middleware('auth');
Route::get('/red-social/mi-perfil/editar/{perfil}',[PerfilController::class,'edit'])->name('perfil.edit')->middleware('auth');
Route::put('/red-social/mi-perfil/editar/{perfil}',[PerfilController::class,'update'])->name('perfil.update')->middleware('auth');

/**Foto de perfil*/
Route::get('/red-social/foto-perfil/editar/{perfil}',[FotoController::class,'edit'])->name('foto.edit')->middleware('auth');
Route::get('/red-social/foto-perfil/checar/{perfil}',[FotoController::class,'check'])->name('foto.check')->middleware('auth');
Route::post('/red-social/foto-perfil/editar/{perfil}',[FotoController::class,'upload'])->name('foto.upload')->middleware('auth');
Route::delete('/red-social/foto-perfil/editar/{perfil}',[FotoController::class,'remove'])->name('foto.remove')->middleware('auth');

/**Amigos*/
Route::get('/red-social/lista-amigos',[AmigoController::class,'index'])->name('amigos.index')->middleware('auth');

/**Buscar*/
Route::get('/red-social/buscar',[BuscarController::class,'__invoke'])->name('buscar.index')->middleware('auth');

/**Consultar estado de la solicitud de amistad*/
Route::get('amigos/consultar-estado/{slug}',[SolicitudAmistadController::class,'consultarEstado'])->middleware('auth')->name('consultar.estado.api');
Route::post('amigos/enviar-solicitud/{slug}',[SolicitudAmistadController::class,'enviarSolicitd'])->middleware('auth')->name('enviar.solicitud.api');
Route::put('amigos/aceptar-solicitud/{slug}',[SolicitudAmistadController::class,'aceptarSolicitud'])->middleware('auth')->name('aceptar.solicitud.api');
Route::delete('amigos/eliminar-solicitud/{slug}',[SolicitudAmistadController::class,'eliminarSolicitud'])->middleware('auth')->name('eliminar.solicitud.api');

/**Notificaciones - solicitides de amistad*/
Route::get('notificaciones/solicitud-amistad/contar',[NotificacionesController::class,'contarSolicitudAmistad'])->middleware('auth')->name('contar.notificaciones');
Route::get('notificaciones/mostrar-nuevas-solicitudes',[NotificacionesController::class,'mostrarNuevasSolicitudes'])->middleware('auth')->name('mostrar.notificaciones');
Route::get('/notificaciones',[NotificacionesController::class,'index'])->middleware('auth')->name('index.notificaciones');
Route::put('/notificaciones/marcar-leido/{id}',[NotificacionesController::class,'marcarLeido'])->middleware('auth')->name('marcar-leidas.notificaciones');
Route::delete('/notificaciones/{id}',[NotificacionesController::class,'destroy'])->middleware('auth')->name('delete.notificaciones');

/**Cuenta*/
Route::get('/red-social/cuenta',[CuentaController::class,'index'])->middleware('auth')->name('cuenta.index');
Route::get('/red-social/cuenta-editar',[CuentaController::class,'edit'])->middleware('auth')->name('cuenta.edit');
Route::get('/red-social/cambiar-password',[CuentaController::class,'editPassword'])->middleware('auth')->name('contrasena.edit');
Route::put('/red-social/cambiar-password',[CuentaController::class,'updatePassword'])->middleware('auth')->name('contrasena.update');
Route::put('/red-social/cuenta',[CuentaController::class,'update'])->middleware('auth')->name('cuenta.update');

/**Mensajes*/
Route::get('/red-social/mensajes',[MensajesController::class,'index'])->middleware('auth')->name('mensajes.index');
Route::get('/red-social/mensajes/{perfil}',[MensajesController::class,'create'])->middleware('auth','show.perfil')->name('mensajes.create');
Route::post('/red-social/mensajes/{perfil}',[MensajesController::class,'store'])->middleware('auth','show.perfil')->name('mensajes.store');

/**Notifacion - mensajes */
Route::get('/notificaciones-mensajes/contar',[NotificacionMensajeController::class,'contarMensajes'])->middleware('auth');
Route::get('/notificaciones-mostrar-mensajes',[NotificacionMensajeController::class,'mostrarNuevosMensajes'])->middleware('auth');
Route::put('/notificaciones-mensajes-marcar-leido/{id}',[NotificacionMensajeController::class,'marcarLeido'])->middleware('auth');