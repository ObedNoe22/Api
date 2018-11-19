<?php

namespace App\Http\Controllers;
use App\Promociones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromocionesController extends Controller
{
    //Agregar promocion
    public function nuevaPromocion(Request $request,$id){
        {
            $validator = Validator::make($request->all(), [
                "descripcion" => "required"
            ], [
                "descripcion.required" => "Debe llenar el campo de descripcion de la promocion."
            ]);
            if($validator->fails())
                return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
            $promocion =new Promociones();
            $promocion->descripcion = $request->input("descripcion");
            $promocion->negocio_id=$id;
            $promocion->save();
            return response()->json(["estado" => true, "detalle" => $promocion]);
        }
    }
    //Eliminar promocion
    public function eliminar($id)
    {
        Promociones::destroy($id);
        return response()->json("", 200);
    }
    //Encontrar al negocio de la promocion
    public function encontrarNegocio($id){
        $promos=Promociones::find($id);
        return json_encode($promos->negocios);
    }
    //Actualizar promocion
    public function actualizarPromocion(Request $request,$id){
        $validator = Validator::make($request->all(), [
            "descripcion" => "required"
        ], [
            "descripcion.required" => "Debe llenar el campo de descripcion de la promocion."
        ]);
        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $promocion =Promociones::find($id);
        $promocion->descripcion = $request->input("descripcion");
        $promocion->save();
        return response()->json(["estado" => true, "detalle" => $promocion]);
    }
    //Ver promocion
    public function verPromo($id){
        $promo=Promociones::find($id);
        return json_encode($promo);
    }
}
