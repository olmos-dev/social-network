<?php

namespace App\Models;

use Database\Factories\PerfilesFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isEmpty;

class Perfil extends Model
{
    use HasFactory;	
    
    protected $table = 'perfil';
    protected $fillable = ['user_id','genero_id','pais_id','idioma_id','username','foto','cumple','descripcion','slug'];

    /**Relacion 1:1 un perfil pertenece a un Usuario*/
    public function usuario(){
        return $this->belongsTo(User::class, 'user_id');
    }

    /**Relación 1:1 un perfil pertenece a un genero*/
    public function genero(){
        return $this->belongsTo(Genero::class, 'genero_id');
    }

    /**Relación 1:1 un perfil pertenece a un pais*/
    public function pais(){
        return $this->belongsTo(Pais::class, 'pais_id');
    }

     /**Relación 1:1 un perfil pertenece a un idioma*/
     public function idioma(){
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }

    /**Relación 1:N Un perfil tiene muchos amigos*/
    public function amigos(){
        return $this->hasMany(Amigo::class);
    }

    /**Relacion 1:N - Un perfil tiene muchos mensajes*/
    public function mensajes(){
        return $this->hasMany(Mensaje::class, 'emisor_id');
    }

    public function messages(){
        return $this->hasMany(Mensaje::class, 'receptor_id');
    }
    
    /**Model biding - funcionando con slug*/
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**Se implementa un scope que recibe parámetros para realizar la búsqueda de los perfiles*/
    public function scopeFiltrar($query,$nombre,$username,$pais,$genero,$edadMayor,$edadMenor,$ordenar)
    {   
        return $query->whereHas('usuario', function($q) use($nombre){
            $q->where('name','like',"%$nombre%");
        })->where('username','like',"%$username%")
            ->where('pais_id','like',"%$pais%")
            ->where('genero_id','like',"%$genero%")
            ->whereBetween('cumple',[$edadMayor,$edadMenor])
            ->orderBy('created_at',$ordenar);
    }

}
