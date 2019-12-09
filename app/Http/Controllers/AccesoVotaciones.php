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
        $votacion = Pregunta::find($id);
        $json = $votacion->opciones;
        $ops = json_decode($json, true);

       return view('opciones')->with('ops', $ops['opciones'])->with('id', $id);
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
            $opciones = json_decode($rec, true);
            $opciones['votos'][$idopcion]++;

            $s = json_encode($opciones);
            $votacion->recuento = $s;
            $votacion->save();

            return view('rectificar')->with('id', $id)->with('idopcion', $idopcion);
            /*Le pasamos la opcion que voto para que si le da a rectificar
              quitar el voto que ya se sumo*/

        }
    }
    public function rectificar()
    {
        if(isset($_POST['rectificacion']) && !empty($_POST['rectificacion']))
        {
            $r1 = $_POST['rectificacion'];
            $l1 = '.';
            $l2 = '-';        
            //Obtener el id de la opción(Si se rectifica o no)
            $o1 = explode($l1, $r1);
            $rct = $o1[0];
            $r2 = $o1[1];
            //Obtener el id de la votación y de la opción que se voto para quitar el voto anterior
            $o2 = explode($l2, $r2);
            $id = $o2[0];
            $idop = $o2[1];

            if($rct == 1)
            {
                //Decrementar el voto anterior
                $votacion = Pregunta::find($id);
                $rec = $votacion->recuento;
                $opciones = json_decode($rec, true);
                $json = $votacion->opciones;
                $ops = json_decode($json, true);

                $opciones['votos'][$idop]--;
                $s = json_encode($opciones);
                $votacion->recuento = $s;
                $votacion->save();

               return view('opciones')->with('ops', $ops['opciones'])->with('id', $id);

/*                $this->enviar($id);
                Así va a la función enviar, pero se queda en la función rectificar y cuando en enviar se llama a la vista opciones peta porque en el web.php pone que se llame desde enviar no desde rectificar.
*/
            }
        }        
    }
}