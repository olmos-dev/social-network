<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Perfil;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Repositories\MiRepository;
use App\Http\Requests\BuscarRequest;

class ComunidadController extends Controller
{
    /**Se inyecta el repositorio a través del contructor para hacer uso de los métodos*/
    public function __construct(MiRepository $repositorio){
        $this->repositorio = $repositorio;
    } 
    /**
     * Muestra los perfiles
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BuscarRequest $request)
    {
        /**Validacion de los datos de busqueda*/
        $validado = $request->validated();

        /**validando la información dependiendo si el usuario envia o no la solicitud para buscar*/
        $name = $validado['name'] ?? null;
        $username = $validado['username'] ?? null;
        $pais = $validado['pais'] ?? null;
        $genero = $validado['genero'] ?? null;
        $edadMayor = $validado['edadMayor'] ?? '60';
        $edadMenor = $validado['edadMenor'] ?? '18';
        $ordenar = $validado['ordenar'] ?? 'desc';


        /**Se sobreescribe el valor de la edad y se converte en una fecha para que pueda realizar la busqueda por años en la BD*/
        $edadMenor = (Carbon::now()->subYears(intval($edadMenor))->format('Y-m-d'));
        $edadMayor = (Carbon::now()->subYears(intval($edadMayor)+1)->format('Y-m-d'));

        /**Se llama el metodo del repositorio y se le pasa los parametros limpiados y preaparados para realizar la busqueda*/
        $perfiles = $this->repositorio->getPerfiles($name,$username,$pais,$genero,$edadMayor,$edadMenor,$ordenar);

        /**Se muetrran los perfiles obtenidos*/
        return view('comunidad.index',compact('perfiles'));
    }

    /**
     * Muestra un perfil en especifico
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {          
        //Laravel utiliza "model biding" que permite realizar la búsqueda del perfil a través del slug y los envimaos a la vista
        return view('comunidad.show',compact('perfil'));
    }   
}
