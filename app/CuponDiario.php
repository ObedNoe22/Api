<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuponDiario extends Model
{
    protected $table = "cupones_diarios";
    //Encontrar al negocio del cupon
    public function negocios(){
        return $this->hasOne("App\Negocio","id","negocio_id");
    }
}