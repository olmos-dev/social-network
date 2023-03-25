<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensaje';
    protected $fillable = ['emisor_id','receptor_id','texto'];
    
    //relacion de uno a muchos para obtener el nombre
    public function emisorNombre(){
        return $this->belongsTo(User::class,'emisor_id');
    }

    //relacion de uno a muchos para obtener el nombre
    public function receptorNombre(){
        return $this->belongsTo(User::class,'receptor_id');
    }

    //relacion de uno a muchos para obtener el perfil
    public function emisorPerfil(){
        return $this->belongsTo(Perfil::class, 'emisor_id');
    }

    //relacion de uno a muchos para obtener el perfil
    public function receptorPerfil(){
        return $this->belongsTo(Perfil::class, 'receptor_id');
    }
}
