<?php

namespace App\Http\Controllers;

use App\ComentarioNegocio;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    public function nuevoN(Request $request, $id)
    {
        $comentario = new ComentarioNegocio();
        $comentario->id_usuario = $request->input('id');
        $comentario->id_negocio = $id;
        $comentario->puntuacion = $request->input('puntuacion');
        $comentario->comentario = $request->input('comentario');
        if (ComentarioNegocio::where('id_usuario', $request->input('id'))->first() == "") {
            $comentario->save();
            return json_encode(["estado"=>true,"comentario"=>$comentario]);
        } else {
            return json_encode(["estado" => false, "detalle" => ["Ya haz realizado un comentario"]]);
        }
    }

    public function resumenN($id)
    {
        $comentarios = ComentarioNegocio::where('id_negocio', $id)->get();
        $suma = 0;
        $nComentarios = 0;
        $promedio=0;
        foreach ($comentarios as $comentario) {
            $suma += $comentario->puntuacion;
            $nComentarios += 1;
        }
        if($suma!==0){
            $promedio = $suma / $nComentarios;
        }
        return json_encode(["promedio"=>$promedio,"comentarios"=>$comentarios]);
    }

    public function editarN(Request $request, $id)
    {
        $comentario = ComentarioNegocio::find($id);
        $comentario->puntuacion = $request->input('puntuacion');
        $comentario->comentario = $request->input('comentario');
        $comentario->save();
        return json_encode(["estado" => true]);
    }
}
