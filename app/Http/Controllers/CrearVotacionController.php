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
        /*
        $eleccion = new Eleccion;

        $request->validate([
            'fechaInicio' => 'date_format:Y-m-d H:m:s|after:today',
            //'fechaFin' => 'date_format:Y-m-d H:m:s|after:today'
        ]);

        $eleccion->grupos = (['grupos' => $request->grupos]);

        $eleccion->candidatos = (['candidatos' => $request->candidatos]);

        $fecha_inicio = date_create($request->input('fecha-eleccion'));
        $eleccion->fechaInicio = $fecha_inicio;

        //$fecha_fin = date_add($fecha_inicio, date_interval_create_from_date_string("10 days"));
        //$eleccion->fechaFin = date_create($fecha_fin);
        // me ha dicho el antonio que si esto debe de estar. 
        // en el html meto en type='time' (buscar info)

        $eleccion->tipoEleccion = $request->input('tipo-eleccion');

        $eleccion->dobleVoto = $request->input('doblevoto') == "si" ? true : false;

        $eleccion->multiple = $request->input('tipo-votacion') == "si" ? true : false;

        $eleccion->save();
        */

        $mensaje = "La eleccion ha sido creado con éxito.";
        return response()->json([
            'mensaje' => $mensaje
        ]);
    }

    public function mandarGrupos() {
        $grupos = Censo::all();
        return response()->json(['grupos' => $grupos]);
    }
    
    public function mandarCandidatos() {
        $candidatos = User::all();
        return response()->json(['candidatos' => $candidatos]);
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