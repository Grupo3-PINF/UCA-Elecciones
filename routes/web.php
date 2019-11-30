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
        Route::post('resultados','ResultadosController@mostrarResultado');
    });


Route::group(
    [
        'middleware' => ['auth','gestion']
    ],function()
    {
        Route::get('crearvotacion','CrearVotacionController@view')->name('crearvotacion');
        Route::post('crearvotacion','CrearVotacionController@crearVotacion');
    }
);

Route::group(
    [
        'middleware' => ['auth','admin']
    ],function()
    {
        Route::get('roles','RolesController@view')->name('roles');
        Route::get('rolesloco', 'RolesController@mostrarRoles')->name('roles.mostrar');
    }
);

Route::view('/', 'index');

Route::view('/accesibilidad', 'legal/accesibilidad');
Route::view('/avisolegal', 'legal/avisolegal');
Route::view('/cookies', 'legal/cookies');


