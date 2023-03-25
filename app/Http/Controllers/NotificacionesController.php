<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Hash;

/**OBTIENE LAS NOTIFICACIONES DE LAS SOLICITUDES DE AMISTAD*/
class NotificacionesController extends Controller
{
    public function index(){
        //obtener todas las notificaciones de las solicitudes de amistad
        $notificaciones =  DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                                ->where('type','App\Notifications\SolicitudAmistad')
                                                ->get();
        
        //marca las notificaciones como leidas
        DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                ->where('type','App\Notifications\SolicitudAmistad')
                                ->where('read_at',null)
                                ->update(['read_at' => Carbon::now()]);

        return view('notificaciones.index',compact('notificaciones'));
    }

    public function destroy($id){
        //Encuentra la notificacion
        $notificacion = DatabaseNotification::findOrFail($id);
        
        //se llama este método para eliminar la notificacion
        $notificacion->delete();

        //se redireciona a la misma página
        return redirect()->back();
    }

    public function marcarLeido($id){
        //Encuentra la notificacion
        $notificacion = DatabaseNotification::findOrFail($id);
        
        //la notificación la marca como leida 
        $notificacion->update([
            'read_at' => Carbon::now()
        ]);
        
        //se envia una respueta de estado 200
        return http_response_code(200);
    }

    //método que cuenta las notificaciones no leidas de las solicitudes de amistad
    public function contarSolicitudAmistad(){
        $notificaciones =  DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                                    ->where('type','App\Notifications\SolicitudAmistad')
                                                    ->where('read_at',null)
                                                    ->count();
        return response()->json($notificaciones);
    }

    //mostrara en el componente de vue, 5 notificaciones
    public function mostrarNuevasSolicitudes(){
        $notificaciones = DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                                ->where('type','App\Notifications\SolicitudAmistad')
                                                ->where('read_at',null)
                                                ->orderBy('created_at','desc')
                                                ->take(5)
                                                ->get();
                                                
        return response()->json($notificaciones);
    }
}
