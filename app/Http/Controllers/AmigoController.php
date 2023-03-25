<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Repositories\MiRepository;
use Illuminate\Http\Request;

class AmigoController extends Controller
{
    /**Se inyecta el repositorio para hacer el uso de sus metodos*/
    public function __construct(MiRepository $repositorio){
        $this->repositorio = $repositorio;
    }

    /**
     * Nuestra los amigos del perfil logueado
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**obtiene los amigos del usuario autenticado*/
        $amigos = $this->repositorio->getAmigos();

        /**cuenta el número de amigos que tiene el usuario autenticado*/
        $numeroAmigos = $this->repositorio->contarAmigos();
        
        /**retorna una vista con el paso de parámetrosS */
        return view('amigos.index',compact('amigos','numeroAmigos'));
    }

}
