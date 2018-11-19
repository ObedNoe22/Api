<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    //Encontrar el negocio del menu
    public function encontrarmenunegoc($id){
        $menus=Menu::find($id);
        return json_encode($menus->encontrarnegocios);
    }
    //Agregar menu
    public function agregarMenu(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            "producto_id" => "required"
        ], [
            "producto_id.required" => "Debe seleccionar un producto que agregar."
        ]);
        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $menu =new Menu;
        $menu->producto_id = $request->input("producto_id");
        $menu->negocio_id=$id;
        $menu->save();
        return response()->json(["estado" => true, "detalle" => $menu]);
    }
    //Eliminar menu
    public function eliminar($id)
    {
        Menu::destroy($id);
        return response()->json("Menu eliminado.", 200);
    }
}
