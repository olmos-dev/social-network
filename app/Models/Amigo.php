<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amigo extends Model
{
    use HasFactory;

    protected $table = 'amigo';
    protected $fillable =  ['usuario_id','perfil_id','estado'];

    /**Es la relacion 1:1 en la tabla amigo en la fk perfil_id pertence a un perfil*/
    public function perfil(){
        return $this->belongsTo(Perfil::class,'perfil_id');
    }

    /**Es la relacion 1:1 en la tabla amigo en la fk usuario_id pertence a un perfil*/
    public function usuario(){
        return $this->belongsTo(Perfil::class,'usuario_id');
    }



}
