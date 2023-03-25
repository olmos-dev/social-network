<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MiRepository;

class BuscarController extends Controller
{
    //se inyecta en el contructor el repositorio para hacer uso de sus métodos
    public function __construct(MiRepository $repositorio){
        $this->repositorio = $repositorio;
    }
    /**
     * Vista para realizar la búsqueda de perfiles
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //se envian estos datos del reporitorio para realizar la búqueda de los perfiles
        $generos = $this->repositorio->getGeneros();
        $idiomas = $this->repositorio->getIdiomas();
        $paises = $this->repositorio->getPaises();
        $sorts = $this->repositorio->getSort();

        //se retorna la vista buscar con el paso de parámetros
        return view('buscar.index',compact('generos','idiomas','paises','sorts'));
    }
}
