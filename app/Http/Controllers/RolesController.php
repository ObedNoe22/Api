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
            "correo" => "required",
            "password" => "required",
            'rpassword' => 'required|same:password'
        ], [
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "correo.required" => "Debe llenar el campo de correo.",
            "password.required" => "Debe llenar el campo del password.",
            "rpassword.same" => "La contraseña y su confirmación deben ser iguales.",
        ]);

        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->correo = $request->input("correo");
        $usuario->password = Hash::make($request->input("password"));
        $usuario->estado = "0";
        $usuario->negocioId = $id;
        $usuario->save();
        return response()->json(["estado" => true]);
    }

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "rolId" => "required",
            "nombre" => "required",
            "correo" => "required"
        ], [
            "rolId.required" => "Por favor seleccionar un rol.",
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "correo.required" => "Debe llenar el campo de correo."
        ]);

        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = Usuario::find($id);
        $usuario->nombre = $request->input('nombre');
        $usuario->rolId = $request->input('rolId');
        $usuario->correo = $request->input('correo');
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

    public function nuevoRol($id)
    {

    }

    public function eliminarUsuario($id)
    {
        Usuario::destroy($id);
        return response()->json(["estado" => true, 200]);
    }

    public function verUsuario($id)
    {
        $usuario=Usuario::find($id);
        return json_encode($usuario);
    }
}
