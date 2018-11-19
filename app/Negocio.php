<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    protected $table = "negocios";
    //Encontrar los productos del negocio
    public function productos()
    {
        return $this->belongsToMany("App\Producto","menu","negocio_id","producto_id");
    }
    //Encontrar los cupones del negocio
    public function cupones(){
        return $this->hasMany("App\CuponDiario","negocio_id","id");
    }
    //Encontrar los menu del negocio
    public function menu(){
        return $this->hasMany("App\Menu","negocio_id","id");
    }
    //Encontrar las promociones del negocio
    public function promocioness(){
        return $this->hasMany("App\Promociones","negocio_id","id");
    }

}
