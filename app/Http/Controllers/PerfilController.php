<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Repositories\MiRepository;
use App\Http\Requests\PerfilRequest;


class PerfilController extends Controller
{
     /**Se inyecta el repositorio a través del contructor para hacer uso de los métodos*/
    public function __construct(MiRepository $repositorio){
        $this->repositorio = $repositorio;
    }

    /**
     * Muestra el perfil logueado
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        //uso del policy - verifica que el usuario autenticado vea su perfil y nadie más
        $this->authorize('view',$perfil);
        
        //método que permite saber el numpero de amigos de cada perfil
        $numeroAmigos = $this->repositorio->contarAmigos();

        //método que cuenta las notificaciones de mensajes nuevos
        $contarNotificacionesMensajes = $this->repositorio->contarNotificacionesMensajes();

        //método que cuenta las notificaciones de solicitudes de amistad nuevas
        $contarNotificacionesSolicitudes = $this->repositorio->contarNotificacionesSolicitudes();
        
        //se retorna la vista del perfil logueado y con el envio de parámetros a la vista
        return view('Perfil.show',compact('perfil','numeroAmigos','contarNotificacionesMensajes','contarNotificacionesSolicitudes'));
    }

    /**
     * Muestra e formulario para editar el perfil
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //uso del policy - verifica que el usuario autenticado edite su perfil y nadie más
        $this->authorize('view',$perfil);

        //uso de los métedos de repositorio para obtener los generos, los idiomas y paises
        $generos = $this->repositorio->getGeneros();
        $idiomas = $this->repositorio->getIdiomas();
        $paises = $this->repositorio->getPaises();

        //retina la vista y pasa los parametros a la vista
        return view('Perfil.edit',compact('perfil','generos','idiomas','paises'));
    }

    /**
     * Actualiza el perfil logueado
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilRequest $request, Perfil $perfil)
    {
        //uso del policy - verifica que el usuario autenticado actualice su perfil y nadie más
        $this->authorize('update',$perfil);
        
        //proceso de validacion
        $validado = $request->validated();

        //actualiza el nombre del perfil
        auth()->user()->update([
            'name' => $validado['name']
        ]);

        //actualiza los demás campos del perfil
        $perfil->update([
            'pais_id' => $validado['pais'],
            'idioma_id' => $validado['idioma'],
            'cumple' => $validado['cumple'],
            'genero_id' => $validado['genero'],
            'descripcion' => $validado['descripcion'],
        ]);

        //se retorna la vista con un mensaje del perfil actulizado
        return redirect()->route('perfil.show',['perfil' => $perfil->slug])->with('sistema','Perfil Actualizado Correctamente');
    }
    
}
