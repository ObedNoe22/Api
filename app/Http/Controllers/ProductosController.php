<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Promociones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
    //Agregar producto
    public function nuevoProducto(Request $request){
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "costo" => "required",
            "disponible" => "required"

        ], [
            "nombre.required" => "Debe llenar el campo de nombre del producto.",
            "costo.required" => "Debe llenar el campo del costo.",
            "disponible.required" => "Debe seleccionar si esta  disponible."
        ]);

        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $producto = new Producto();
        $producto->nombre = $request->input("nombre");
        $producto->costo = $request->input("costo");
        $producto->disponible = $request->input("disponible");
        $producto->save();
        return response()->json(["estado" => true, "detalle" => $producto]);
    }
    //Eliminar producto
    public function eliminar($id)
    {
        Producto::destroy($id);
        return response()->json("", 200);
    }
    //Encontrar al negocio del producto
    public function encontrarNegocio($id){
        $productos=Producto::find($id);
        return json_encode($productos->negocios);
    }
    //Ver producto
    public function verProducto($id){
        $producto=Producto::find($id);
        return json_encode($producto);
    }
    //Actualizar producto
    public function actualizarProducto(Request $request,$id){
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "costo" => "required",
            "disponible" => "required"

        ], [
            "nombre.required" => "Debe llenar el campo de nombre del producto.",
            "costo.required" => "Debe llenar el campo del costo.",
            "disponible.required" => "Debe seleccionar si esta  disponible."
        ]);

        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $producto = Producto::find($id);
        $producto->nombre = $request->input("nombre");
        $producto->costo = $request->input("costo");
        $producto->disponible = $request->input("disponible");
        $producto->save();
        return response()->json(["estado" => true, "detalle" => $producto]);
    }
}
