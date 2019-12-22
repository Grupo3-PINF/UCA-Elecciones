<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Redirect;
use Session;
use Auth;
use App;
use App\User;
use App\Pregunta;
use App\Participacion;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
        $date = date('Y-m-d H:i:s');
        $array = [];
        foreach($pnr as $p)
        {
            if($date > $p->fechaComienzo && $date < $p->fechaFin)
                array_push($array,$p);
        }
        return view('preguntasnorestringidas')->with('pnr', $array);
    }
    public function preguntasRestringidas()
    {
        $pr = Pregunta::where('esRestringida', true)->get();
        $date = date('Y-m-d H:i:s');
        $array = [];
        foreach($pr as $p)
        {
            if($date > $p->fechaComienzo && $date < $p->fechaFin)
                array_push($array,$p);
        }
        
        return view('preguntasrestringidas')->with('pr', $array);
    }
    public function mostrarElecciones()
    {

    }
    public function mostrarConsultas()
    {

    }
    public function enviar($id)
    {
        //Para comprobar que un usuario ya ha votado o no
        $usuario = Session::get('idusuario');
        //Sacamos el id del usuario a partir del login de usuario
        $user = User::where('login', $usuario)->first();
        $iduser = $user->id;
        $votado = Participacion::where('idusuario', $iduser)->where('idpregunta', $id)->first();

        if($votado != null)
        {
            $pregunta = $votado->idpregunta;
        }
        else
        {
            //Si es null dará true en votado == null y para evitar que $pregunta esté vacío le asignaamos un valor cualquiera
            $pregunta = -1;
        }
        if($votado == null || $pregunta != $id || $votado->opcion == 1000000)
        {      

            $votacion = Pregunta::find($id);
            $date = date('Y-m-d H:i:s');
            $tiempo_ini = $votacion->fechaComienzo;
            $tiempo_fin = $votacion->fechaFin;

            $json = $votacion->opciones;
            $ops = json_decode($json, true);
            if($date > $tiempo_ini && $date < $tiempo_fin)
            {
                //Apuntamos que el usuario ha votado(la opción la apuntamos después)
                $participacion = new Participacion;
                $participacion->idusuario = $iduser;
                $participacion->idpregunta = $id;
                $participacion->opcion = 1000000;
                $participacion->save();

                return view('opciones')->with('ops', $ops['opciones'])->with('id', $id)->with('tiempo_ini', $tiempo_ini)->with('tiempo_fin', $tiempo_fin)->with('pregunta', $votacion->titulo);
            }
            else
            {
                return "Votación finalizada";
            }
        }
        else
        {
            return redirect('accesovotaciones');
        }
    }
    public function guardaropcion()
    {
        if(isset($_POST['respuesta']) && !empty($_POST['respuesta']))
        {
            $idvotacion = $_POST['respuesta'];
            $limite = '.';
            
            //Separamos la cadena recibida que contiene el id de la pregunta y el id de la opción
            $ops = explode($limite, $idvotacion);
            $idopcion = $ops[0];
            $id = $ops[1];

            //Registrar el usuario como que ya ha votado a dicha pregunta y comprobar que no vota más de 1 vez
            $usuario = Session::get('idusuario');
            //Sacamos el id del usuario a partir del login de usuario
            $user = User::where('login', $usuario)->first();
            $iduser = $user->id;
            //Buscamos la fila en la base de datos Participación que coincida con el usuario y pregunta
            $votado = Participacion::where('idpregunta', '=', $id)->where('idusuario', '=', $iduser)->first();

            //Si no es nulo es que ha retrocedido la página e intenta votar otra vez
            if($votado->opcion == 1000000)
            {
                $votacion = Pregunta::find($id);
                $votado->opcion = $idopcion;
                $votado->save();
                
                $date = date('Y-m-d H:i:s');
                $tiempo_ini = $votacion->fechaComienzo;
                $tiempo_fin = $votacion->fechaFin;

                $rec = $votacion->recuento;
                $opciones = json_decode($rec, true);
                $opciones['votos'][$idopcion]++;

                $s = json_encode($opciones);
                $votacion->recuento = $s;

                if($date > $tiempo_ini && $date < $tiempo_fin)
                {
                    $process = Process::fromShellCommandline("/usr/local/bin/python3 /Applications/MAMP/htdocs/UCA-Elecciones/resources/vottingDapp/cambiar_estado.py ".$votacion->wallet." ".$user->wallet." 1");
                    $process->run();
                    $process = Process::fromShellCommandline("/usr/local/bin/python3 /Applications/MAMP/htdocs/UCA-Elecciones/resources/vottingDapp/votar.py ".$votacion->wallet." ".$user->wallet." ".$idopcion);
                    $process->run();
                    if (!$process->isSuccessful()) {
                        throw new ProcessFailedException($process);
                    }
                    $votacion->save();
                    //return view('rectificar')->with('id', $id)->with('idopcion', $idopcion);
                    /*Le pasamos la opcion que voto para que si le da a rectificar
                      quitar el voto que ya se sumo*/
                    return redirect('/');

                }else
                {
                    return redirect('/');
                }               
            }else
            {
                echo 'ya has votado';
                return redirect('accesovotaciones');
            }
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
                $votacion = Pregunta::find($id);
                $date = date('Y-m-d H:i:s');
                $tiempo_ini = $votacion->fechaComienzo;
                $tiempo_fin = $votacion->fechaFin;

                if($date > $tiempo_ini && $date < $tiempo_fin)
                {
                    //Decrementar el voto anterior
                    $rec = $votacion->recuento;
                    $opciones = json_decode($rec, true);
                    $json = $votacion->opciones;
                    $ops = json_decode($json, true);

                    $opciones['votos'][$idop]--;
                    $s = json_encode($opciones);
                    $votacion->recuento = $s;
                    $votacion->save();

                   return redirect('accesovotaciones')->with('ops', $ops['opciones'])->with('id', $id);
                }else
                {
                    return "Votación finalizada";
                }
            }else
            {
                return redirect('accesovotaciones');
            }
        }        
    }
}