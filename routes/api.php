<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
    Route::post("nuevoUsuario","UsuariosController@nuevoUsuario");//Crear usuario
    Route::post("nuevoVendedor","UsuariosController@nuevoVendedor");//Crear vendedor
    Route::post("login","UsuariosController@autenticar");//Ruta publica del login

Route::group(["middleware" => "jwt"],function(){ //Grupo de rutas cuando el token sea correcto
    /************************************
     **            Usuarios            **
     ************************************/
    Route::get("me","UsuariosController@usuarioAutenticado");//Usuarios autenticados
    Route::get("verUsuario/{id}","UsuariosController@verUsuario");//Usuarios autenticados
    Route::post("editarUsuario/{id}","UsuariosController@editarUsuario");//Editar
    /************************************
     **            Negocios            **
     ************************************/
    Route::get("verNegocio/{id}","NegociosController@verNegocio");//Ver negocio
    Route::get("todosNegoc/{id}","NegociosController@todos");//Todos los negocios
    Route::post("nuevoNegocio/{id}","NegociosController@crear");//Ruta para agregar negocio
    Route::post("actualizarNegocio/{id}","NegociosController@actualizarNegocio");//Ruta para actualizar un negocio
    Route::delete("eliminarNegocio/{id}","NegociosController@eliminar");//Eliminar negocio
    Route::get("negocioCupones/{id}","NegociosController@encontrarCupones");//Encontrar los cupones de un negocio
    Route::get("negocioMenu/{id}","NegociosController@encontrarMenu");//Encontrar los menus de un negocio
    Route::get("negocioPromos/{id}","NegociosController@encontrarPromociones");//Encontrar las promociones de un negocio
    Route::get("negocioProductos/{id}","NegociosController@encontrarProductos");//Encontrar los productos de un negocio
    /************************************
     **            Cupones             **
     ************************************/
    Route::post("nuevoCupon/{id}","CuponesController@nuevo");//Agregar cupones diarios
    Route::get("cuponesNegocio/{id}","CuponesController@encontrarNegocio");//Encontrar al negocio de los cupones diarios
    Route::delete("eliminarCupon/{id}","CuponesController@eliminar");//Eliminar cupon diario
    Route::post("actualizarCupon/{id}","CuponesController@actualizarCupon");//Ruta para actualizar un cupon
    Route::get("verCupon/{id}","CuponesController@verCupon");//Ver promocion
    /************************************
     **            Menu                **
     ************************************/
    Route::post("nuevoMenu/{id}","MenuController@agregarMenu");//Agregar menu
    Route::get("menuNegocio/{id}","MenuController@encontrarmenunegoc");//Encontrar al negocio del menu
    Route::delete("eliminarMenu/{id}","MenuController@eliminar");//Eliminar menu
    /************************************
     **          Promociones           **
     ************************************/
    Route::post("nuevaPromo/{id}","PromocionesController@nuevaPromocion");//Agregar promocion
    Route::delete("eliminarPromo/{id}","PromocionesController@eliminar");//Eliminar promocion
    Route::get("promosNegocio/{id}","PromocionesController@encontrarNegocio");//Encontrar al negocio de la promo
    Route::post("actualizarPromo/{id}","PromocionesController@actualizarPromocion");//Actualizar promocion
    Route::get("verPromo/{id}","PromocionesController@verPromo");//Ver promocion
    Route::get("promosGlobales","PromocionesController@globales");//Promociones globales
    /************************************
     **            Producto            **
     ************************************/
    Route::post("nuevoProducto/{id}","ProductosController@nuevoProducto");//Agregar producto
    Route::delete("eliminarProducto/{id}","ProductosController@eliminar");//Eliminar producto
    Route::get("productoNegocio/{id}","ProductosController@encontrarNegocio");//Encontrar al negocio del producto
    Route::get("verProducto/{id}","ProductosController@verProducto");//Ver producto
    Route::post("actualizarProducto/{id}","ProductosController@actualizarProducto");//Actualizar producto
    /************************************
     **        Roles/Usuarios          **
     ************************************/
    Route::post("nuevoUsuarioNegocio/{id}","RolesController@nuevoUsuario");//Crear usuario de un negocio
    Route::post("nuevoRol/{id}","RolesController@nuevoRol");//Crear usuario de un negocio
    Route::post("editar/{id}","RolesController@editar");//Asinar un rol
    Route::get("encontrarUsuarios/{id}","RolesController@encontrarUsuarios");//Encontrar usuarios de un negocio
    Route::get("encontrarRoles/{id}","RolesController@encontrarRoles");//Encontrar roles de un negocio
    Route::delete("eliminarUsuario/{id}","RolesController@eliminarUsuario");//Eliminar usuario de un negocio
});

