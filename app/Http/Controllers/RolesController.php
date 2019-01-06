<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Vendedor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function nuevoUsuario(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "password" => "required",
            'rpassword' => 'required|same:password'
        ], [
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "password.required" => "Debe llenar el campo del password.",
            "rpassword.same" => "La contraseña y su confirmación deben ser iguales.",
        ]);

        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->password = Hash::make($request->input("password"));
        $usuario->estado = "Inactivo";
        $usuario->negocioId = $id;
        $usuario->save();
        return response()->json(compact('usuario'), 201);
    }

    public function asignarRol(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "rol" => "required"
        ], [
            "rol.required" => "Por favor seleccionar un rol."
        ]);

        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = Usuario::find($id);
        $usuario->rolId = $request->input('rol');
        $usuario->estado = $request->input('estado');
        $usuario->save();
        return response()->json(['usuario' => $usuario, "estado" => true]);
    }

    public function encontrarUsuarios($id)
    {
        $usuarios = Usuario::find($id);
        return json_encode($usuarios->usuariosNegocio);
    }

    public function encontrarRoles($id)
    {
        $roles = Vendedor::find($id);
        return json_encode($roles->rolesNegocio);
    }
    public function nuevoRol($id){

    }
}
