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

    private function interpretarFecha(String $str) {
        if (preg_match("/^(19[0-9]{2}|2[0-9]{3})-(0[1-9]|1[012])-([123]0|[012][1-9]|31)T([01][0-9]|2[0-3]):([0-5][0-9])(:([0-5][0-9]))?$/", $str)) {
            $dstr = str_replace('T', ' ', $str);
            $dstr = $dstr.':00';
            return $dstr;
        }
        return NULL;
    }

    public function crearPregunta(Request $request)
    {    
        // validar titulo
        // TODO filtar posible titulo dañino
        $titulo = $request->input('titulo');
        if ($titulo == NULL) {
            return response()->json([
                'status' => false,
                'mensaje' => "Es necesario poner un titulo",
                'data' => $request->all()
            ]);
        }

        // validar la fecha
        $fechaStr = $request->input('fecha-inicio');

        if ($fechaStr == NULL) {
            return response()->json([
                'status' => false,
                'mensaje' => "Fecha incompleta"
            ]);
        }

        $fechaStr = $this->interpretarFecha($fechaStr);

        // si no es correcta, o es anterior a "ahora"
        if ($fechaStr == NULL || strtotime($fechaStr) - time() < 0) {
            return response()->json([
                'status' => false,
                'mensaje' => "Fecha incorrecta",
            ]);
        }

        $fechaIni = date_create($fechaStr);

        $duracion = $request->input('tiempo-pregunta');
        if (is_numeric($duracion)) {
            $fechaFin = clone $fechaIni;
            $fechaFin->modify("+$duracion minutes");
        }

        // validar la fecha anticipada
        $esAnticipada = $request->input('es-anticipada') == "true" ? true : false;
        if ($esAnticipada) {
            $fechaAnticipadaStr = $request->input('fecha-pregunta-anticipada');

            if ($fechaAnticipadaStr == NULL) {
                return response()->json([
                    'status' => false,
                    'mensaje' => "Fecha anticipada incompleta",
                ]);
            }

            $fechaAnticipadaStr = $this->interpretarFecha($fechaAnticipadaStr);

            // si no es correcta, o es anterior a "ahora"
            if ($fechaAnticipadaStr == NULL || strtotime($fechaAnticipadaStr) - time() < 0) {
                return response()->json([
                    'status' => false,
                    'mensaje' => "Fecha anticipada incorrecta"
                ]);
            }

            $fechaAnticipada = date_create($fechaAnticipadaStr);
        }

        // validar las opciones
        $esCompleja = $request->input('es-compleja') == "true" ? true : false;
        if ($esCompleja) {
            $opciones = json_encode(["opciones"=>$request->input('opciones-compleja')]);
        } else {
            $opciones = json_encode(["opciones"=>["Si","No","Abstencion"]]);
        }

        $pregunta = new Pregunta;
        $pregunta->titulo = $titulo;
        
        $pregunta->esVinculante = $request->input('es-secreta') == "true" ? true : false;
        $pregunta->esCompleja = $request->input('es-compleja') == "true" ? true : false;
        $pregunta->esRestringida = $request->input('es-secreta') == "true" ? true : false;
        
        $pregunta->fechaComienzo = $fechaIni;
        $pregunta->fechaFin = $fechaFin;
        
        $pregunta->esAnticipada = $esAnticipada;
        if ($esAnticipada) {
            $pregunta->fechaComienzoAnticipada = $fechaAnticipada;
        }

        $pregunta->opciones = $opciones;
        $pregunta->recuento = $recuento;

        $pregunta->censoVotante = json_encode(['grupos' => $request->input('grupos')]);

        $pregunta->censoVotante = json_encode(['grupos' => $request->input('grupos')]);

        $pregunta->idCreador = \Auth::user()->id;

        // $pregunta->wallet = EL SCRIPT DE LA BLOCKCHAIN;

        $pregunta->save();

        return response()->json([
            'status' => true,
            'mensaje' => "Pregunta creada correctamente"
        ]);
        
        // mientras no tenemos ajax, devolvemos una vista
        // return view('crearvotacion')->with('mensaje',$mensaje);
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
        // !!! APLICAR FILTRO !!!
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