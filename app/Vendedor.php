<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = "vendedor";
    //Encontrar los roles de un vendedor
    public function rolesNegocio(){
        return $this->hasMany("App\Roles","vendedorId","id");
    }
}