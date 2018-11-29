<?php

namespace App\Http\Controllers;
use App\Usuario;
use App\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuariosController extends Controller
{
    //Login
    public function autenticar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "password" => "required|min:6"
        ],[
            "nombre.required" => "Falta el campo nombre.",
            "password.required" => "Falta el campo contraseña.",
            "password.min" => "La contraseña debe ser de al menos 6 carácteres."
        ]);
        if($validator->fails())
        {
            return response()->json(["estado" => false,"detalle" => $validator->errors()->all()]);
        }
        $credenciales = $request->only('nombre', 'password');
        try {
            if (! $token = JWTAuth::attempt($credenciales)) {
                return response()->json(["estado" => false,'detalle' => ['Login incorrecto: credenciales erróneas.']]);
            }
        } catch (JWTException $e) {
            return response()->json(["estado" => false,'detalle' => ['Login incorrecto: Error en el server.']]);
        }
        return response()->json(["estado"=> true, "detalle" => $token,'user'=>$request->input('nombre')]);
    }
    public function usuarioAutenticado()
    {
        try {
            if (! $usuario = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('usuario'));
    }
    //Agregar usuario
    public function nuevoUsuario(Request $request){
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "password" => "required"

        ], [
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "password.required" => "Debe llenar el campo del password."
        ]);

        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->password = Hash::make($request->input("password"));
        $usuario->estado="Inactivo";
        $usuario->save();
        $token = JWTAuth::fromUser($usuario);
        return response()->json(compact('usuario', 'token'), 201);
    }
    //Agregar vendedor
    public function nuevoVendedor(Request $request){
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "password" => "required",
            "nombrec" => "required",
            "apellidos" => "required"
        ], [
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "password.required" => "Debe llenar el campo del password.",
            "nombrec.required" => "Por favor llenar el campo de su nombre.",
            "apellidos.required" => "Debe llenar el campo de sus apellidos."
        ]);
        if($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $vendedor=new Vendedor();
        $vendedor->nombre=$request->input("nombrec");
        $vendedor->apellidos=$request->input("apellidos");
        $vendedor->save();
        $idvend=$vendedor->id;
        //Se agrega al vendedor a la tbala usuarios con su vendedor ID
        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->password = Hash::make($request->input("password"));
        $usuario->vendedorId=$idvend;
        $usuario->estado="Inactivo";
        $usuario->save();
        $token = JWTAuth::fromUser($usuario);
        return response()->json(compact('usuario', 'token'), 201);
    }
}
