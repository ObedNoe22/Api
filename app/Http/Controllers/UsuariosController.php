<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Intervention\Image\ImageManagerStatic as Image;

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
            "correo" => "required",
            "password" => "required|min:6",
            "rpassword" => "required|same:password"
        ], [
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "correo.required" => "Debe llenar el campo de correo.",
            "password.required" => "Debe llenar el campo del password.",
            "password.min" => "La contraseña debe ser de al menos 6 carácteres.",
            "rpassword.same" => "La contraseña y su confirmación deben ser iguales.",
            "rpassword.required" => "La confirmacion de contraseña es requerida."
        ]);

        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->password = Hash::make($request->input("password"));
        $usuario->estado = "0";
        $usuario->correo = $request->input("correo");
        $imagenNueva = $request->file('imagen');
        $extension = $imagenNueva->getClientOriginalExtension();
        $imagenRezize = Image::make($imagenNueva->getRealPath());
        $imagenRezize->resize(150, 150);
        $imagenRezize->save(public_path("storage/" . "aaaa" . "." . $extension));
        $usuario->imagenPerfil = "aa" . "." . $extension;
        $usuario->save();
        $token = JWTAuth::fromUser($usuario);
        return response()->json(compact('usuario', 'token'), 201);
    }

    //Agregar vendedor
    public function nuevoVendedor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "nombrec" => "required",
            "apellidos" => "required",
            "password" => "required",
            "correo" => "required",
            "rpassword" => "required|same:password"
        ], [
            "nombre.required" => "Por favor llenar el campo de nombre de usuario.",
            "nombrec.required" => "Por favor llenar el campo de nombre.",
            "apellidos.required" => "Por favor llenar el campo de apellidos.",
            "correo.required" => "Por favor indicar un correo electronico",
            "password.required" => "Debe llenar el campo del password.",
            "rpassword.same" => "La contraseña y su confirmación deben ser iguales.",
            "rpassword.required" => "La confirmacion de contraseña es requerida."
        ]);
        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = new Usuario();
        $usuario->nombre = $request->input("nombre");
        $usuario->password = Hash::make($request->input("password"));
        $usuario->correo = $request->input("correo");
        $usuario->estado = "0";
        $usuario->rolId = "1";
        $usuario->imagenPerfil=".jpeg";
        $usuario->save();
        //Guarda el usuario
        //Se crea la imagen de perfil con el id
        $idvend=$usuario->id;
        $usuario=Usuario::find($idvend);
        $imagenNueva = $request->input('imagen');
        $imagenRezize = Image::make($imagenNueva);
        $imagenRezize->resize(150, 150);
        $imagenRezize->save(public_path("storage/" . $idvend . ".jpeg"));
        $usuario->imagenPerfil=$idvend.".jpeg";
        $usuario->save();
        $token = JWTAuth::fromUser($usuario);
        //Se agrega al vendedor a la tabla vendedores con su vendedor ID
        $vendedor = new Vendedor();
        $vendedor->id = $idvend;
        $vendedor->nombre = $request->input("nombrec");
        $vendedor->apellidos = $request->input("apellidos");
        $vendedor->save();
        $estado=true;
        return response()->json(compact('usuario', 'token',"estado"), 201);
    }

    //VerUsuario
    public function verUsuario($id)
    {
        $usuario = Usuario::find($id);
        return json_encode($usuario);
    }

    public function editarUsuario($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            "nombre" => "required",
            "password" => "required|min:6"
        ], [
            "nombre.required" => "Por favor llenar el campo de nombre.",
            "password.required" => "Debe llenar el campo del password.",
            "password.min" => "La contraseña debe ser de al menos 6 carácteres."
        ]);

        if ($validator->fails())
            return response()->json(["estado" => false, "detalle" => $validator->errors()->all()]);
        $usuario = Usuario::find($id);
        $pass = $usuario->password;
        if (Hash::check($request->input('password'), $pass)) {
            $imagenVieja = $usuario->imagenPerfil;
            if (Storage::disk('public_uploads')->exists($imagenVieja) == null) {
                Storage::disk('public_uploads')->delete($imagenVieja);
                $imagenNueva = $request->input('imagenPerfil');
                $imagenRezize = Image::make($imagenNueva);
                $imagenRezize->resize(150, 150);
                $imagenRezize->save(public_path("storage/" . $id . ".jpeg"));
                $usuario->imagenPerfil=$id.".jpeg";
                $usuario->nombre=$request->input('nombre');
                $usuario->save();
                return json_encode(["estado" => true]);
            }
            $imagenNueva = $request->input('imagenPerfil');
            $imagenRezize = Image::make($imagenNueva);
            $imagenRezize->resize(150, 150);
            $imagenRezize->save(public_path("storage/" . $id . ".jpeg"));
            $usuario->imagenPerfil=$id.".jpeg";
            $usuario->nombre=$request->input('nombre');
            $usuario->save();
            return json_encode(["estado" => true]);
        }
        return json_encode(["estado" => false, "detalle" => ["Contraseña incorrecta"]]);
    }
}
