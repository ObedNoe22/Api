<?php

namespace App\Http\Controllers;
use App\CuponDiario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CuponesController extends Controller
{
    //Agregar cupon
    public function nuevo(Request $request,$id){
        $validator = Validator::make($request->all(), [
            "codigo" => "required",
            "descripcion" => "required"

        ], [
            "nombre.required" => "Debe llenar el campo de nombre del negocio.",
            "direccion.required" => "Debe llenar el campo de direccion."
        ]);

        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $cupon = new CuponDiario();
        $cupon->codigo = $request->input("codigo");
        $cupon->negocio_id=$request->input('negocio_id');
        $cupon->descripcion = $request->input("descripcion");
        $cupon->caducidad = $request->input("caducidad");
        $cupon->usos = $request->input("usos");
        $cupon->tipo = $request->input("tipo");
        $cupon->activo = $request->input("activo");
        $cupon->save();
        return response()->json(["estado" => true, "detalle" => $cupon]);
    }
    //Encontrar al negocio del cupon
    public function encontrarNegocio($id){
        $cupones=CuponDiario::find($id);
        return json_encode($cupones->negocios);
    }
    //Eliminar cupon
    public function eliminar($id)
    {
        CuponDiario::destroy($id);
        return response()->json(["estado"=>true,200]);
    }
    //Actualizar cupon
    public function actualizarCupon(Request $request,$id){
        $validator = Validator::make($request->all(), [
            "codigo" => "required",
            "descripcion" => "required",
        ], [
            "codigo.required" => "Debe llenar el campo del codigo.",
            "descripcion.required" => "Debe llenar el campo de descripcion del codigo."
        ]);
        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $cupon=CuponDiario::find($id);
        $cupon->tipo = $request->input("tipo");
        $cupon->codigo = $request->input("codigo");
        $cupon->descripcion = $request->input("descripcion");
        $cupon->caducidad = $request->input("caducidad");
        $cupon->usos = $request->input("usos");
        $cupon->activo = $request->input("activo");
        $cupon->save();
        return response()->json(["estado" => true, "detalle" => $cupon]);
    }
    //Ver cupon
    public function verCupon($id){
        $cupon=CuponDiario::find($id);
        return json_encode($cupon);
    }
}
