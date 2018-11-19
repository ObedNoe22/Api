<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
    //Encontrar al negocio del menu
    public function encontrarnegocios(){
    return $this->belongsTo("App\Negocio","negocio_id","id");
    }
}