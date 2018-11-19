<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $usuario = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['estado' => false, "detalle" => ["Sesión inválida, vuelva a intentarlo"]]);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['estado' => false,"detalle" => ["Sesión expirada, vuelva a iniciar sesión"]]);
            }else{
                return response()->json(['estado' => "false", "detalle" => ["Sesión errónea, vuelva a intentarlo"]]);
            }
        }
        return $next($request);
    }
}
