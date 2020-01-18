<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login','Auth\LoginController@index')->name('login');
Route::post('login','Auth\LoginController@login');

Route::group(
    [
    'middleware'=>'auth'
    ],function()
    {
        Route::get('logout','Auth\LoginController@logout');
        Route::get('/', function () 
        {
            return view('index');
        });
        Route::get('resultados','ResultadosController@view')->name('resultados');
        Route::post('resultados','ResultadosController@mostrarResultado')->name('resultado.post');

        //Acceder a la vista con todas las preguntas y elecciones
        Route::get('accesovotaciones', 'AccesoVotaciones@index')->name('accesovotaciones');

        //Llegar a la vista opciones para preguntas
        Route::get('opciones/{id?}{pregunta?}', 'AccesoVotaciones@enviar');
        //Hacer el post desde opciones para preguntas
        Route::post('opciones', 'AccesoVotaciones@guardaropcion');

        //Llegar a la vista de rectificar para preguntas
        Route::get('rectificar/{id?}{pregunta?}', 'AccesoVotaciones@rectificarvoto');
        //Hacer el post desde rectificar para preguntas
        Route::post('rectificar', 'AccesoVotaciones@guardaropcion');

        //Llegar a la vista opciones para elecciones
        Route::get('opciones_eleccion/{id?}{pregunta?}', 'AccesoVotaciones@enviar_elecciones');
        //Hacer el post desde opciones para elecciones
        Route::post('opciones_eleccion', 'AccesoVotaciones@guardaropcion_elecciones');
    });


Route::group(
    [
        'middleware' => ['auth','gestion']
    ],function()
    {
        Route::get('crearvotacion','CrearVotacionController@view')->name('crearvotacion');
        //Route::post('crearvotacion','CrearVotacionController@crearVotacion');
        Route::get('modificarvotacion','ModificarVotacionController@view')->name('modificarvotacion');
        Route::get('modificarvotacion/elecciones','ModificarVotacionController@consultarElecciones');
        Route::get('modificarvotacion/preguntas','ModificarVotacionController@consultarPreguntas');
        Route::post('modificarvotacion/recibirGrupos','ModificarVotacionController@mandarGrupos')->name('modvotacion.recibirGrupos');
        Route::post('modificarvotacion/recibirCandidatos','ModificarVotacionController@mandarCandidatos')->name('modvotacion.recibirCandidatos');
        Route::post('modificarvotacion/modificarPregunta','ModificarVotacionController@modificarPregunta')->name('modvotacion.modificarPregunta');
        Route::post('modificarvotacion/modificarEleccion','ModificarVotacionController@modificarEleccion')->name('modvotacion.modificarEleccion');
        Route::post('modificarvotacion/mostrarCampos','ModificarVotacionController@mostrarCampos')->name('modvotacion.mostrarCampos');
        Route::get('borrarvotacion','BorrarVotacionController@index')->name('borrarvotacion');
        Route::post('borrarvotacion','BorrarVotacionController@eliminar')->name('borrarvotacion.borrar');
        Route::post('crearvotacion/seleccionVotacion','CrearVotacionController@seleccionVotacion');
        Route::post('crearvotacion/recibirGrupos','CrearVotacionController@mandarGrupos');
        Route::post('crearvotacion/recibirCandidatos','CrearVotacionController@mandarCandidatos');
        Route::post('crearvotacion/crearEleccion','CrearVotacionController@crearEleccion');
        Route::post('crearvotacion/crearPregunta','CrearVotacionController@crearPregunta');
    }
);

Route::group(
    [
        'middleware' => ['auth','admin']
    ],function()
    {
        Route::get('roles','RolesController@view')->name('roles');
        Route::post('roles-mostrar', 'RolesController@mostrarRoles')->name('roles.mostrar');
        Route::post('roles-añadir','RolesController@agregarRol')->name('roles.agregar');
        Route::post('roles-eliminar','RolesController@quitarRol')->name('roles.eliminar');
        Route::post('roles-modificar','RolesController@rolActivo')->name('roles.modificar');
    }
);

Route::view('/', 'index');

Route::view('/accesibilidad', 'legal/accesibilidad');
Route::view('/avisolegal', 'legal/avisolegal');
Route::view('/cookies', 'legal/cookies');