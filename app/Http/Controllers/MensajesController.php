<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Mensaje;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Notifications\Mensajes;
use App\Repositories\MiRepository;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MensajeRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\DatabaseNotification;

class MensajesController extends Controller
{
    public function __construct(MiRepository $repositorio){
        $this->repositorio = $repositorio;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**Marcar como leido todas las notificaciones de mensajes*/
        DatabaseNotification::where('notifiable_id',auth()->user()->id)
                                                ->where('type','App\Notifications\Mensajes')
                                                ->where('read_at',null)
                                                ->update(['read_at' => Carbon::now()]);
    
        //se llama el repositorio para obtener todos los mensajes de los perfiles que el usuario ha conversado
        $mensajes = $this->repositorio->mensajesIndex();

        //se hace un filtrado de los datos para que los perfiles no se repitan y se envien a la vista
        $mensajes = $mensajes->unique('receptor_id');

        //se envian los perfiles a la vista index
        return view('mensajes.index',compact('mensajes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Perfil $perfil)
    {

        $receptor = $this->repositorio->perfilConversacion($perfil);
        $mensajes = $this->repositorio->conversaciones($perfil);

        return view('mensajes.create',compact('receptor','mensajes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MensajeRequest $request,Perfil $perfil)
    {
        $validado = $request->validated();

        $mensaje = Mensaje::create([
            'emisor_id' => auth()->user()->id,
            'receptor_id' => $perfil->user_id,
            'texto' => $validado['mensaje']
        ]);

        /**Notifica a la persono a la que se envio la solicitud de amistad*/
        $notificar = $perfil->usuario;

        /**Es el usuario de quien envio la solicitud de amistad*/
        $nombre = auth()->user()->name;
        $slug = auth()->user()->perfil->slug;
        $texto = $mensaje->texto;
 
        /**Se envia la notificacion*/
        $notificar->notify(new Mensajes($nombre,$slug,$texto));
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
