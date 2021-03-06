<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Negocio;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class NegociosController extends Controller
{
    //Agregar nuevo negocio,solo datos necesarios
    public function crear(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "direccion" => "required"

        ], [
            "nombre.required" => "Debe llenar el campo de nombre del negocio.",
            "direccion.required" => "Debe llenar el campo de direccion."
        ]);

        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);

        $negocio = new Negocio();
        $negocio->nombre = $request->input("nombre");
        $negocio->vendedorId = $id;
        $negocio->direccion = $request->input("direccion");
        $negocio->longitud = $request->input("longitud");
        $negocio->latitud = $request->input("latitud");
        $negocio->correo = $request->input("correo");
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

    //Encontrar los cupones de un negocio
    public function encontrarCupones($id)
    {
        $negocios = Negocio::find($id);
        return json_encode($negocios->cupones);
    }

    //Encontrar los menus de un negocio
    public function encontrarMenu($id)
    {
        $negocios = Negocio::find($id);
        return json_encode(["estado"=>true,"menu"=>$negocios->menu]);
    }

    //Encontrar las promociones de un negocio
    public function encontrarPromociones($id)
    {
        $negocios = Negocio::find($id);
        $promos=$negocios->promociones;
        return json_encode(["estado" => true, "negocio" => $negocios->nombre, "promociones" => $promos]);
    }

    //Encontrar los productos de un negocio
    public function encontrarProductos($id)
    {
        $negocios = Negocio::find($id);
        return json_encode($negocios->productos);
    }

    //Ver negocio
    public function verNegocio($id)
    {
        $negocio = Negocio::find($id);
        return json_encode($negocio);
    }

    //Todos los negocios
    public function todos($id)
    {
        $negocios = Negocio::where('vendedorId', $id)->get();
        return json_encode($negocios);
    }

    //Actualizar datos de un negocio
    public function actualizarNegocio(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "direccion" => "required"

        ], [
            "nombre.required" => "Debe llenar el campo de nombre del negocio.",
            "direccion.required" => "Debe llenar el campo de direccion."
        ]);
        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $negocio = Negocio::find($id);
        $negocio->nombre = $request->input("nombre");
        $negocio->direccion = $request->input("direccion");
        $negocio->longitud = $request->input("longitud");
        $negocio->latitud = $request->input("latitud");
        $negocio->horario = $request->input("horario");
        $negocio->correo = $request->input("correo");
        $negocio->save();
        return response()->json(["estado" => true, "detalle" => $negocio]);
    }
    public function cambiarEstNeg($id){
        $negocio=Negocio::find($id);
        if($negocio->disponibilidad==1){
            $negocio->disponibilidad=0;
        }else{
            $negocio->disponibilidad=1;
        }
        $negocio->save();
        return response()->json(["estado"=>true]);
    }
    public function globales(){
        $negocios=Negocio::all();
        return json_encode(["estado"=>true,"negocios"=>$negocios]);
    }
}
