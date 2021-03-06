<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Auth', 'prefix' => 'auth'], function ($api) {
        $api->post('login', ['as' => 'login', 'uses' => 'AuthApiController@login']);
        $api->post('register', 'AuthApiController@register');
        $api->post('logout', 'AuthApiController@logout', ['middleware' => ['auth.jwt']]);
        $api->get('refresh', 'AuthApiController@refresh', ['middleware' => ['auth.jwt']]);
        $api->get('user', 'AuthApiController@me', ['middleware' => ['auth.jwt']]);
    });

    $api->get('imagen', 'App\Http\Controllers\Producto\ProductoController@mostrarImagen')->name('productos.mostrarImagen');
    $api->group(['middleware' => ['auth.jwt','bindings']], function ($api) {
        $api->resource('categorias','App\Http\Controllers\Categoria\CategoriaController');
        $api->resource('productos', 'App\Http\Controllers\Producto\ProductoController');
        $api->resource('ventas', 'App\Http\Controllers\Venta\VentaController');
        $api->resource('clientes', 'App\Http\Controllers\Cliente\ClienteController');
        $api->resource('tipo_documentos', 'App\Http\Controllers\TipoDocumento\TipoDocumentoController');
    });
});
