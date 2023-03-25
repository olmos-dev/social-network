<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use App\Http\Requests\FotoRequest;
use function PHPUnit\Framework\isEmpty;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Exceptions\HttpResponseException;

class FotoController extends Controller
{
    /**
     * Muestra el formulario para editar la foto de perfil
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //uso del policy para que el perfil loqueado sea quien pueda editar la foto de perfil y nadie más
        $this->authorize('view',$perfil);
        return view('foto.edit',compact('perfil'));
    }

    /**
     * Actualiza la foto de perfil
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function upload(FotoRequest $request, Perfil $perfil)
    {
        //verifica que sea una petición ajax
        if($request->ajax()){
            //verifica que el fomulario se envie una foto
            if($request->hasFile('foto')){
                //se verifica si el perfil tiene una foto, de lo contratario elimina la foto en el disco
                if($perfil->foto !== null){
                    Storage::disk('public')->delete($perfil->foto);
                }
                //crea la ruta donde se almacenará la foto de perfil
                $ruta = Storage::disk('public')->put('fotos',$request->file('foto'));
                //se actualiza la ruta de la foto de perfil
                $uploaded = $perfil->update([
                    'foto' => $ruta
                ]);
                //se envia una respuesta json
                return response()->json($uploaded);
            }
            return abort(404);
        }
        return abort(404);
    }

    /**
     * Elimina la foto de perfil
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request, Perfil $perfil)
    {
        //verifica que sea una petición ajax
        if($request->ajax()){
            //elimina la foto del perfil del disco
            Storage::disk('public')->delete($perfil->foto);
           
            //actualiza la ruta de la foto de perfil a vacio
            $perfil->update([
                'foto' => null,
            ]);

            //retorna una respuesta de estado 200
            return http_response_code(200);
        }
        return abort(404);
    }

    //método que verifica si el perfil tiene una foto de perfil o no
    public function check(Request $request, Perfil $perfil){
        if($request->ajax()){
            return response()->json($perfil,200);
        }
        return http_response_code(404);
    }

    
}
