<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ShowPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /**Se obtiene el slug que se envia a treves de la URL y se verifica con el slug del usuario autenticado*/
        if($request->route('perfil')->slug === auth()->user()->perfil->slug){
            /**Se impide el accedo porque el usuario no puede enviarse mensajes asimismo y tampoco solicitudes de amistad*/
            return abort(403);
        }else{
            return $next($request);
        } 
    }
}
