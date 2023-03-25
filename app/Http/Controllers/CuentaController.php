<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CuentaRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class CuentaController extends Controller
{
    /**
     * Vista de la cuenta del usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //se envia el usuario logueado a la vista
        $usuario = auth()->user();
        return view('cuenta.index',compact('usuario'));
    }

    /**
     * Muestra el formaulario para editar la cuenta del usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //se envia el usuario logueado a la vista
        $usuario = auth()->user();
        return view('cuenta.edit',compact('usuario'));
    }

    /**
     * Actualiza los datos del perfil
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CuentaRequest $request)
    {
        //validación de los datos
        $validado = $request->validated();
        
        //verifica si la contraseña del usuario es correcta para poder actualizar los datos
        if(Hash::check($validado['password'], auth()->user()->password)){
            //actualiza los datos del usuario loguqeado en la BD
            auth()->user()->update([
                'name' => $validado['nombre'],
                'email' => $validado['email']
            ]);
            //retorna una vista con un mensaje de confirmación 
            return redirect()->back()->with('sistema','La cuenta se actualizó correctamente');
        }else{
             //retorna una vista con un mensaje de error
            return redirect()->back()->with('error','Escriba la contraseña nuevamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //retorna la vista para cambiar la contraseña
    public function editPassword(){
        return view('password.edit');
    }

    //método para actualizar la contraseña de la cuenta
    public function updatePassword(PasswordRequest $request){

        //validación de los datos
        $validado = $request->validated();

        //verifica si la contraseña del usuario es correcta para poder actualizar los datos
        if(Hash::check($validado['pass'], auth()->user()->password)){
            //actualiza la contraseña en la BD
            auth()->user()->update([
                'password' => Hash::make($validado['password']),
            ]);
             //retorna una vista con un mensaje de confirmación 
            return redirect()->back()->with('sistema','EL password se actualizó correctamente');
        }else{
             //retorna una vista con un mensaje de error
            return redirect()->back()->with('error','Escriba la contraseña nuevamente');
        }
    }
}
