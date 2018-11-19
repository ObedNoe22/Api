<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    //Encontrar el negocio del producto
    public function negocios(){
       return $this->belongsToMany("App\Negocio","menu","producto_id","negocio_id");
    }
}