<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

/**OBTIENE LAS NOTIFICACIONES DE LOS MENSAJES*/
class NotificacionMensajeController extends Controller
{
    //cuenta las notificaciones de los mensajes no leidos
    public function contarMensajes(){
        $notificaciones = DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                                ->where('type','App\Notifications\Mensajes')
                                                ->where('read_at',null)
                                                ->count();
        return response()->json($notificaciones);

    }

    //muestra las notificaciones de los mensajes no leidos
    public function mostrarNuevosMensajes(){
        $notificaciones = DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                                ->where('type','App\Notifications\Mensajes')
                                                ->where('read_at',null)
                                                ->orderBy('created_at','desc')
                                                ->take(5)
                                                ->get();
        return response()->json($notificaciones);
    }

    //marca las notificaciones a leidas de los mensajes
    public function marcarLeido($id){
        $notificacion = DatabaseNotification::findOrFail($id);
        $notificacion->update([
            'read_at' => Carbon::now()
        ]);        
        return http_response_code(200);
    }
}
