<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});




// Autenticación en la API:

Route::post('login', 'ApiController@login');
Route::middleware('auth:api')->post('logout', 'ApiController@logout');



// Testeo:

Route::middleware('auth:api')->get('bajo', 'ApiController@testBajo');
Route::middleware('auth:api')->get('alto', 'ApiController@testAlto');

Route::middleware('auth:api')->get('hola', function (Request $request) {
    return response()->json([
        'message' => 'ola caracola, tú eres...',
        'user' => $request->user(),
    ], 200);
});

//fin testeo Carlos


//Ruta de prueba para crear usuarios
Route::middleware('auth:api')->get('holausuario','getresultController@index'); //hola mundo que necesita registrarse

Route::middleware('auth:api')->post('crearusuario','getresultController@store'); //crear usuario que necesita registrarse

//Rutas de metodos de Votaciones
Route::middleware('auth:api')->get('getpreguntas','PreguntasController@getpreguntas');

Route::middleware('auth:api')->post('crearpregunta','votacionesController@store');
//Rutas de metodos de Elecciones
Route::middleware('auth:api')->get('getelecciones','EleccionesController@getelecciones');

Route::middleware('auth:api')->post('creareleccion','EleccionesController@store');
