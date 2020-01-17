<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;

use App\User;
use App\Pregunta;
use App\Eleccion;
use App\Censo;
use Illuminate\Http\Request;

class BorrarVotacionController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d H:i:s');
        $preguntas = Pregunta::where('fechaComienzo','>',$date)->get();
        $elecciones = Eleccion::where('fechaInicio','>',$date)->get();
        $array = [ "preguntas"=>$preguntas,"elecciones"=>$elecciones];
        return view('borrarvotacion')->with($array);
    }

    public function eliminarP(Request $request)
    {
            $pregunta = Pregunta::find($request->input('pregunta'));
            if(isset($pregunta))
            {
                $pregunta->delete();
                return response()->json(['value'=>true,
                                'message'=>"Pregunta eliminada correctamente"]);
            }
            else
                return response()->json(["value"=>false,
                                        "message"=>"Ha  ocurrido un error"]);
    }

    public function eliminarE(Request $request)
    {
            $eleccion = Eleccion::find($request->input('eleccion'));
            if(isset($eleccion))
            {
                $eleccion->delete();
                return response()->json(["value"=>true,
                                "message"=>"Elección eliminada correctamente"]);
            }
            else
                return response()->json(["value"=>false,
                                "message"=>"Ha  ocurrido un error"]);
    }

    public function eliminar(Request $request)
    {
        if($request->input('tipo')=="pregunta")
            return $this->eliminarP($request);
        else if($request->input('tipo')=="eleccion")
            return $this->eliminarE($request);
        else
            return response()->json(["value"=>false,
                                    "message"=>"Ha  ocurrido un error"]);
    }
}