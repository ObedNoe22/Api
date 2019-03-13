<?php

namespace App\Http\Controllers;

use App\Promociones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromocionesController extends Controller
{
    //Agregar promocion
    public function nuevaPromocion(Request $request, $id)
    {
        {
            $validator = Validator::make($request->all(), [
                "descripcion" => "required",
                "disponible" => "required"
            ], [
                "descripcion.required" => "Debe llenar el campo de descripcion de la promocion.",
                "disponible.required" => "Debe validar si esta disponible o no"
            ]);
            if ($validator->fails())
                return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
            $promocion = new Promociones();
            $promocion->descripcion = $request->input("descripcion");
            $promocion->disponible = $request->input("disponible");
            $promocion->negocio_id = $id;
            $promocion->save();
            return response()->json(["estado" => true, "detalle" => $promocion]);
        }
    }

    //Eliminar promocion
    public function eliminar($id)
    {
        Promociones::destroy($id);
        return response()->json(["estado"=>true,200]);
    }

    //Encontrar al negocio de la promocion
    public function encontrarNegocio($id)
    {
        $promos = Promociones::find($id);
        return json_encode($promos->negocios);
    }

    //Actualizar promocion
    public function actualizarPromocion(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "descripcion" => "required",
            "disponible" => "required"
        ], [
            "descripcion.required" => "Debe llenar el campo de descripcion de la promocion.",
            "disponible.required" => "Debe validar si esta disponible o no"
        ]);
        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $promocion = Promociones::find($id);
        $promocion->descripcion = $request->input("descripcion");
        $promocion->disponible = $request->input("disponible");
        $promocion->save();
        return response()->json(["estado" => true, "detalle" => $promocion]);
    }

    //Ver promocion
    public function verPromo($id)
    {
        $promo = Promociones::find($id);
        return json_encode($promo);
    }
    public function globales(){
        $promocionesT=[];
        $promociones=Promociones::where('disponible',1)->get();
        foreach ($promociones as $promocion){
            $negocio= $promocion->negocios;
            $promocionn=["promocion"=>$promocion,"negocio"=>$negocio];
            array_push($promocionesT,$promocionn);
        }
        return json_encode($promocionesT);
    }
}
