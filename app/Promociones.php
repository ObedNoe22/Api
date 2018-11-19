<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
    protected $table = "promociones";
    //Encontrar al negocio de la promocion
    public function negocios(){
        return $this->hasOne("App\Negocio","id","negocio_id");
    }
}