<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Redirect;
use Session;
use Auth;

use App\User;
use App\Pregunta;

class AccesoVotaciones extends Controller
{
    public function index()
    {
        return view('accesovotaciones');
    }
    public function Vistapr()
    {
        return view('preguntasrestringidas');
    }
    public function Vistapnr()
    {
        return view('preguntasnorestringidas');
    }
    public function preguntasNoRestringidas()
    {
        $pnr = Pregunta::where('esRestringida', false)->get();
        return view('preguntasnorestringidas')->with('pnr', $pnr);
        //Enviar las preguntas
        //accesoVotaciones()
    }
    public function preguntasRestringidas()
    {
        $pr = Pregunta::where('esRestringida', true)->get();
        return view('preguntasrestringidas')->with('pr', $pr);
    }
    public function mostrarElecciones()
    {

    }
    public function mostrarConsultas()
    {

    }
    public function enviar($id)
    {
        $opciones = Pregunta::select('opciones')->where('id', $id)->get();
        $limite = ',';
        
        $opciones = substr($opciones, 16, -5);
        $ops = explode($limite, $opciones);

        return view('opciones')->with('ops', $ops)->with('id', $id);
    }
    public function guardaropcion()
    {
        if(isset($_POST['respuesta']) && !empty($_POST['respuesta']))
        {
            $idvotacion = $_POST['respuesta'];
            $limite = '.';
            
            $ops = explode($limite, $idvotacion);
            $idopcion = $ops[0];
            $id = $ops[1];

            $votacion = Pregunta::find($id);
            $rec = $votacion->recuento;
            $jotason = json_encode($rec);
            echo $jotason;
//            $recuento = Pregunta::select('recuento')->where('id', $id)->first();
//            $aux = json_decode("votos");
//            $aux[idopcion]++;
           // die(var_dump($recuento));
//            echo $jotason['votos'][0];
//            return $votacion->recuento[votos][0];
//            return $rec[0];
//            return view('index');
        }        
//        return view('index');
    }
}
     
