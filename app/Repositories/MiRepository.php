<?php
namespace App\Repositories;

use App\Models\Mensaje;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Uid\NilUlid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Models\{Genero,Idioma,Pais,Amigo,Perfil};
use Illuminate\Notifications\DatabaseNotification;

class MiRepository{
    /**Obtener todos los géneros ordenados alfabéticamente */
    public function getGeneros(){
        return Genero::select('id','nombre','ruta')
                        ->orderBy('nombre','asc')
                        ->get();
    }

    /**Obtener todos los idiomas ordenados alfabéticamente */
    public function getIdiomas(){
        return Idioma::select('id','nombre')
                        ->orderBy('nombre','asc')
                        ->get();
    }

    /**Obtener todos los paises ordenados alfabéticamente */
    public function getPaises(){
        return Pais::select('id','nombre','ruta')
                        ->orderBy('nombre','asc')
                        ->get();
    }

    /**Obtener los metodos de ordenamiento de la base de datos*/
    public function getSort(){
        return DB::select('select id,sort from buscar');
    }

    /**obtener todos los amigos del usuario logueado*/
    public function getAmigos(){
        return Amigo::with('perfil:id,user_id,foto,slug','usuario:id,user_id,foto,slug')
                        ->where('usuario_id',Auth::user()->id)
                        ->orWhere('perfil_id',Auth::user()->id)
                        ->orderBy('updated_at','desc')
                        ->get(['usuario_id','perfil_id','estado','updated_at'])
                        ->where('estado',1);
                        
    }

    /**Cuenta el número de amigos del usuario logueado*/
    public function contarAmigos(){
        return Amigo::where('usuario_id',Auth::user()->id)
                        ->orWhere('perfil_id',Auth::user()->id)
                        ->orderBy('updated_at','desc')
                        ->get(['estado'])
                        ->where('estado',1)
                        ->count();
    }

    /**Muestra los perfiles después de realizar una búsqueda, se hace uso del scope que de definió en el modelo Perfil*/
    public function getPerfiles($name,$username,$pais,$genero,$edadMayor,$edadMenor,$ordenar){
        return Perfil::with('usuario:id,name','genero:id,ruta','pais:id,nombre,ruta','idioma:id,nombre')
                        ->where('user_id','!=',auth()->user()->id)
                        ->filtrar($name,$username,$pais,$genero,$edadMayor,$edadMenor,$ordenar)
                        ->paginate(10);
    }

    /**Cuenta el numero de notificaciones no leidas de los mensajes*/
    public function contarNotificacionesMensajes(){
        return DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                ->where('type','App\Notifications\Mensajes')
                                ->where('read_at',null)
                                ->count();
    }

    /**Cuenta el numero de notificaciones no leidas de las solicitudes de amistad*/
    public function contarNotificacionesSolicitudes(){
        return DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                ->where('type','App\Notifications\SolicitudAmistad')
                                ->where('read_at',null)
                                ->count();
    }

    /**Obtiene las conversaciones o chats del usuario que ha realizado con un perfil en especifico*/
    public function conversaciones($perfil){
        return Mensaje::where('emisor_id',auth()->user()->id)
                            ->where('receptor_id',$perfil->user_id)
                            ->orWhere('emisor_id',$perfil->user_id)
                            ->where('receptor_id',auth()->user()->id)
                            ->orderby('created_at','asc')
                            ->get(['emisor_id','receptor_id','texto','created_at']);
    }

    /**Obtiene los datos del perfil con quien el usuario ha coversado o chateado*/
    public function perfilConversacion($perfil){
        return Perfil::with('usuario:id,name')
                        ->where('id',$perfil->id)
                        ->first(['id','user_id','slug','foto']);
    }

    /**Obtiene todos los perfiles con quien el usuario a conversado */
    public function mensajesIndex(){
        return Mensaje::with('emisorPerfil:id,user_id,foto,slug','receptorPerfil:id,user_id,foto,slug','emisorNombre:id,name','receptorNombre:id,name')
                            ->where('emisor_id',auth()->user()->id)
                            ->orWhere('receptor_id',auth()->user()->id)
                            ->orderBy('created_at','desc')
                            ->get(['emisor_id','receptor_id','texto','created_at']);
    }
    
}