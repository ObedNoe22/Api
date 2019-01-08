<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuariosController extends Controller
{
    //Login
    public function autenticar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "password" => "required|min:6",
        ], [
            "nombre.required" => "Falta el campo nombre.",
            "password.required" => "Falta el campo contraseña.",
            "password.min" => "La contraseña debe ser de al menos 6 carácteres."
        ]);
        if ($validator->fails()) {
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        }
        $credenciales = $request->only('nombre', 'password');
        try {
            if (!$token = JWTAuth::attempt($credenciales)) {
                return response()->json(["estado" => false, 'detalle' => ['Login incorrecto: credenciales erróneas.']]);
            }
        } catch (JWTException $e) {
            return response()->json(["estado" => false, 'detalle' => ['Login incorrecto: Error en el server.']]);
        }
        $usuario = Usuario::where('nombre', $request->input('nombre'))->first();
        $idUsu = $usuario->id;
        $rolId = $usuario->rolId;
        $nombre = Vendedor::where('id', $idUsu)->first();
        return response()->json(["estado" => true, "detalle" => $token, 'user' => $request->input('nombre'), 'vendedor' => $nombre, 'rol' => $rolId]);

    }

    //Agregar usuario
    public function nuevoUsuario(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "password" => "required|min:6",
            "rpassword" => "required|same:password"
        ], [
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "password.required" => "Debe llenar el campo del password.",
            "password.min" => "La contraseña debe ser de al menos 6 carácteres.",
            "rpassword.same" => "La contraseña y su confirmación deben ser iguales."
        ]);

        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->password = Hash::make($request->input("password"));
        $usuario->estado = "Inactivo";
        $usuario->save();
        $token = JWTAuth::fromUser($usuario);
        return response()->json(compact('usuario', 'token'), 201);
    }

    //Agregar vendedor
    public function nuevoVendedor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "password" => "required",
            "correo" => "required",
            "rpassword" => "required|same:password",
            "nombrec" => "required",
            "apellidos" => "required"
        ], [
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "correo.required" => "Por favor indicar un correo electronico",
            "password.required" => "Debe llenar el campo del password.",
            "rpassword.same" => "La contraseña y su confirmación deben ser iguales.",
            "nombrec.required" => "Por favor llenar el campo de su nombre.",
            "apellidos.required" => "Debe llenar el campo de sus apellidos."
        ]);
        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->password = Hash::make($request->input("password"));
        $usuario->correo = $request->input("correo");
        $usuario->negocioId = "";
        $usuario->estado = "Inactivo";
        $usuario->rolId = "1";
        $usuario->save();
        $idvend = $usuario->id;
        $token = JWTAuth::fromUser($usuario);
        return response()->json(compact('usuario', 'token'), 201);
        //Se agrega al vendedor a la tbala vendedores con su vendedor ID
        $vendedor = new Vendedor();
        $vendedor->id = $idvend;
        $vendedor->nombre = $request->input("nombrec");
        $vendedor->apellidos = $request->input("apellidos");
        $vendedor->save();
    }
}
