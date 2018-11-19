<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Negocio;
use Illuminate\Support\Facades\Validator;

class NegociosController extends Controller
{
    //Agregar nuevo negocio,solo datos necesarios
    public function crear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "direccion" => "required"

        ], [
            "nombre.required" => "Debe llenar el campo de nombre del negocio.",
            "direccion.required" => "Debe llenar el campo de direccion."
        ]);

        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);

        $negocio = new Negocio();
        $negocio->nombre = $request->input("nombre");
        $negocio->direccion = $request->input("direccion");
        $negocio->longitud = $request->input("longitud");
        $negocio->latitud = $request->input("latitud");
        $negocio->disponibilidad = "0";
        $negocio->horario = "";
        $negocio->save();
        return response()->json(["estado" => true, "detalle" => $negocio]);
    }
    //Eliminar negocio
    public function eliminar($id)
    {
        Negocio::destroy($id);
        return response()->json("", 200);
    }
    //Agregar la disponibilidad y el horario
    public function disponibilidad_horario(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            "horario" => "required",
            "disponibilidad" => "required"
        ], [
            "horario.required" => "Debe llenar el campo de horario del negocio.",
            "disponibilidad.required" => "Debe llenar el campo de disponibilidad del negocio."
        ]);
        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $negocio = Negocio::find($id);
        $negocio->menu = $request->input("horario");
        $negocio->cupones_diarios = $request->input("disponibilidad");
        $negocio->save();
        return response()->json(["estado" => true, "detalle" => $negocio]);
    }
    //Encontrar los cupones de un negocio
    public function encontrarCupones($id){
        $negocios=Negocio::find($id);
        return json_encode($negocios->cupones);
    }
    //Encontrar los menus de un negocio
    public function encontrarMenu($id){
        $negocios=Negocio::find($id);
        return json_encode($negocios->menu);
    }
    //Encontrar las promociones de un negocio
    public function encontrarPromociones($id){
        $negocios=Negocio::find($id);
        return json_encode($negocios->promocioness);
    }
    //Encontrar los productos de un negocio
    public function encontrarProductos($id){
        $negocios=Negocio::find($id);
        return json_encode($negocios->productos);
    }
    //Ver negocio
    public function verNegocio($id){
        $negocio=Negocio::find($id);
        return json_encode($negocio);
    }
    public function actualizarNegocio(Request $request,$id){
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "direccion" => "required"

        ], [
            "nombre.required" => "Debe llenar el campo de nombre del negocio.",
            "direccion.required" => "Debe llenar el campo de direccion."
        ]);
        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $negocio=Negocio::find($id);
        $negocio->nombre = $request->input("nombre");
        $negocio->direccion = $request->input("direccion");
        $negocio->longitud = $request->input("longitud");
        $negocio->latitud = $request->input("latitud");
        $negocio->save();
        return response()->json(["estado" => true, "detalle" => $negocio]);
    }
}
