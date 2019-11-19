<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;

use App\User;
use App\Pregunta;

class CrearVotacionController extends Controller
{
	public function view()
    {
        return view('crearvotacion');
    }

    public function crearVotacion()
    {
        if(isset($_POST) && !empty($_POST)) {
            $titulo = $_POST['pregunta-basica'];
            
            $pregunta = new Pregunta;
            $pregunta->titulo = $titulo;
            
            // $pregunta->esVinculante = $_POST['eleccion-1'];
            // $pregunta->esCompleja = $_POST['eleccion-2'];
            // $pregunta->esRestringida = $_POST['eleccion-3'];

            $pregunta->fechaComienzo = date_create(date("Y-m-d H:i:s"));
            $pregunta->fechaFin = date_create(date("Y-m-d H:i:s"));
            $pregunta->save();


            $mensaje = "Pregunta creada correctamente";
            
            return view('crearvotacion')->with('mensaje',$mensaje);


            //json_encode(["OK" => 1, "pepito" => $hola]);
            return response()->json([
                ok => 1,
                success => true,
                data => $data
            ]);
        }
    }
}