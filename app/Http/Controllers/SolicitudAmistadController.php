<?php

namespace App\Http\Controllers;

//se importan los modelos
use App\Models\User;
use App\Models\Amigo;
use App\Models\Perfil;
use Illuminate\Http\Request;

//se importan las notificaciones de base de datos
use App\Notifications\SolicitudAmistad;
use function PHPUnit\Framework\isEmpty;

class SolicitudAmistadController extends Controller
{
    /**Consulta el estado de la solicitud de amistad en relacion por el perfil seleccionado*/
    public function consultarEstado($slug){

        //realiza una búsqueda del perfil por el slug  
        $amigo = Perfil::where('slug',$slug)->first();

        //verifica si el perfil existe o no
        if ($amigo != null){

            //se busca el estado de la solicitud de amistad en la BD
            $estado = Amigo::where('usuario_id',auth()->user()->id)
                            ->where('perfil_id',$amigo->id)
                            ->orWhere('usuario_id',$amigo->id)
                            ->where('perfil_id',auth()->user()->id)
                            ->first();

            //se envia el estado en respuesta json
            return response()->json($estado);
        
        }else{
            return abort(404);
        }

    }

    /**Se crea un registro en la BD de la solicitud de amistad*/
    public function enviarSolicitd($slug){
        
        //realiza una búqueda del perfil por el slug  
        $perfil = $this->buscarPerfilSlug($slug);

        //se crea la solicitud de amistad
        $soliciud = Amigo::create([
                'usuario_id' => auth()->user()->id,
                'perfil_id' => $perfil->id,
                'estado' => 0,
        ]);

        /**Notifica a la persono a la que se envio la solicitud de amistad*/
        $notificar = $perfil->usuario;

        /**Es el usuario de quien envio la solicitud de amistad*/
        $nombre = auth()->user()->name;
        $slug = auth()->user()->perfil->slug;

        /**Se envia la notificacion*/
        $notificar->notify(new SolicitudAmistad($nombre,$slug));
        
        //se envia un el código de estado 200 
        return response()->json($soliciud,200);

    }


    /**El perfil quien recibe la solicitud de amistad es quien acepta la solicitud*/
    public function aceptarSolicitud($slug){
        
        //realiza una búsqueda del perfil por el slug  
        $perfil = $this->buscarPerfilSlug($slug);
        
        //se realiza la búsqueda de la solicitud de amistad para que el campo sea actulizado en la BD
        $soliciud = Amigo::select('id')
                        ->where('usuario_id',auth()->user()->id)
                        ->where('perfil_id',$perfil->id)
                        ->orWhere('usuario_id',$perfil->id)
                        ->where('perfil_id',auth()->user()->id)
                        ->first();

        //se acepta la solicitud de amistad
        $soliciud->update([
            'estado' => 1
        ]);   

        //se envia una respuesta en formato json
        return response()->json('aceptado');
    }


    /**Se elimina la solicitud de amistad de la BD */
    public function eliminarSolicitud($slug){

        //realiza una búqueda del perfil por el slug  
        $perfil = $this->buscarPerfilSlug($slug);
        
        //se obtiene el registro de donde se encuetra la solicitud de amistad en la BD
        $soliciud = Amigo::select('id')
                            ->where('usuario_id',auth()->user()->id)
                            ->where('perfil_id',$perfil->id)
                            ->orWhere('usuario_id',$perfil->id)
                            ->where('perfil_id',auth()->user()->id)
                            ->first();

        //se elimina la solicitud de amistad de la BD
        $elimnado = $soliciud->delete();

        //se envia en formato json la respuesta solicitud eliminada
        return response()->json($elimnado);
    }


    /**es un método que retorna si el perfil existe o no*/
    public function buscarPerfilSlug($slug){

        //se realiza una búsqueda del perfil por slug
        $perfil = Perfil::select('id','user_id')->where('slug',$slug)->first(); 

        //verifica si el perfil exite o no y retorna una respuesta
        if($perfil != null)
            return $perfil;  
        return abort(404);
        
    }




}
