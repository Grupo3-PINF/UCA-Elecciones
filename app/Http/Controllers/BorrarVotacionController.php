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
    public function view()
    {
        $date = date('Y-m-d H:i:s');
        $preguntas = Pregunta::where('fechaComienzo','>',$date)->get();
        $elecciones = Eleccion::where('fechaInicio','>',$date)->get();
        $array = [ "preguntas"=>$preguntas,"elecciones"=>$elecciones];
        return view('borrarvotacion')->with($array);
    }

    public function eliminarP()
    {
        if(isset($_POST['pregunta']) && !empty($_POST['pregunta']))
        {
            $pregunta = Pregunta::find($_POST['pregunta']);
            if(isset($pregunta))
            {
                $pregunta->delete();
                return "Pregunta eliminada correctamente";
            }
            else
                return "Ha ocurrido un error.";
        }  
        else
            return "Ha ocurrido un error.";
    }

    public function eliminarE()
    {
        if(isset($_POST['eleccion']) && !empty($_POST['eleccion']))
        {
            $eleccion = Eleccion::find($_POST['eleccion']);
            if(isset($eleccion))
            {
                $eleccion->delete();
                return "Elección eliminada correctamente";
            }
            else
                return "Ha ocurrido un error.";
        }  
        else
            return "Ha ocurrido un error.";
    }
}