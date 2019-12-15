<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;

use App\User;
use App\Pregunta;
use App\Censo;
use Illuminate\Http\Request;

class CrearVotacionController extends Controller
{
	public function view()
    {
        return view('crearvotacion');
    }

    public function crearPregunta(Request $request)
    {
        if(isset($_POST) && !empty($_POST)) {
            $titulo = $request->input('pregunta-basica');
            
            $pregunta = new Pregunta;
            $pregunta->titulo = $titulo;
            
            $pregunta->esVinculante = $request->input('eleccion-2') == "si" ? true : false;
            $pregunta->esCompleja = $request->input('eleccion-3') == "si" ? true : false;
            $pregunta->esRestringida = $request->input('eleccion-4') == "si" ? true : false;
            $pregunta->fechaComienzo = date_create(date("Y-m-d H:i:s"));
            $pregunta->fechaFin = date_create(date("Y-m-d H:i:s"));
            $pregunta->save();

            $mensaje = "Pregunta creada correctamente";
            
            // mientras no tenemos ajax, devolvemos una vista
            return view('crearvotacion')->with('mensaje',$mensaje);

            // para cuando tengamos ajax
            return response()->json([
                ok => 1,
                success => true,
                data => $data
            ]);
        }
    }

    public function crearEleccion(Request $request)
    {
    public function mandarGrupos()
    {
        $grupos = Censo::all();
        return response()->json([
            'grupos' => $grupos
        ]);
    }

    // Creo que esto ya no hace falta.
    public function crearVotacion(Request $request)
    {
        switch($request->input('eleccion-1')) {
            case 'pregunta':
                return $this->crearPregunta($request);
            break;
            case 'eleccion':
                return $this->crearEleccion($request);
            break;
        }
        
    }

    public function seleccionVotacion(Request $request)
    {
        $tipo = $request->input('tipoVotacion');
        return response()->json(['tipo' => $tipo]);
    }
}