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
use App\Eleccion;
use App\Participacion;

class AccesoVotaciones extends Controller
{
    public function index()
    {
        //Preguntas
        $pnr = Pregunta::all();
        $date = date('Y-m-d H:i:s');
        $array_pnr = [];
        foreach($pnr as $p)
        {
            if($date > $p->fechaComienzo && $date < $p->fechaFin)
                array_push($array_pnr,$p);
        }
        //Consultas
        $consultas = [];
        //Elecciones
        $elecciones = [];//Pregunta::all();
        $date = date('Y-m-d H:i:s');
        $array_el = [];
        foreach($elecciones as $e)
        {
            if($date > $e->fechaInicio && $date < $e->fechaFin)
                array_push($array_el,$e);
        }

        return view('accesovotaciones')->with('pnr', $array_pnr)->with('consultas', $consultas)->with('elecciones', $elecciones);
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

                return view('opciones')->with('ops', $ops['opciones'])->with('id', $id)->with('pregunta', $votacion->titulo);
            }
            else
            {
                return redirect()->route("accesovotaciones")->with('error','Votación finalizada');
            }
        }
        else
        {
            return redirect()->route("accesovotaciones")->with('error','Usted ya ha votado');
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
                $date = date('Y-m-d H:i:s');
                $tiempo_ini = $votacion->fechaComienzo;
                $tiempo_fin = $votacion->fechaFin;
                if($date > $tiempo_ini && $date < $tiempo_fin)
                {
                    $votado->opcion = $idopcion;
                    $votado->save();

                    $rec = $votacion->recuento;
                    $opciones = json_decode($rec, true);
                    $opciones['votos'][$idopcion]++;

                    $s = json_encode($opciones);
                    $votacion->recuento = $s;
                    $votacion->save();

                    return redirect()->route("accesovotaciones")->with('success','Votación realizada');

                }else
                {
                    return redirect()->route("accesovotaciones")->with('error','Votación finalizada');
                }               
            }else
            {
                return redirect()->route("accesovotaciones")->with('error','Usted ya ha votado');
            }
        }
    }
/*
    public function enviar_elecciones($id)
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
            {
                return redirect()->route("accesovotaciones")->with('error','Votación finalizada');
            }
        }
        else
        {
            return redirect()->route("accesovotaciones")->with('error','Usted ya ha votado');
        }
    }
    public function guardaropcion_elecciones()
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
                $votado->opcion = $idopcion;
                $votado->save();

                $votacion = Pregunta::find($id);
                $date = date('Y-m-d H:i:s');
                $tiempo_ini = $votacion->fechaComienzo;
                $tiempo_fin = $votacion->fechaFin;

                $rec = $votacion->recuento;
                $opciones = json_decode($rec, true);
                $opciones['votos'][$idopcion]++;

                $s = json_encode($opciones);
                $votacion->recuento = $s;
                $votacion->save();

                if($date > $tiempo_ini && $date < $tiempo_fin)
                {
                    //return view('rectificar')->with('id', $id)->with('idopcion', $idopcion);

                    return redirect()->route("accesovotaciones")->with('success','Votación realizada');

                }else
                {
                    return redirect()->route("accesovotaciones")->with('error','Votación finalizada');
                }               
            }else
            {
                return redirect()->route("accesovotaciones")->with('error','Usted ya ha votado');
            }
        }
    }
*/
    public function rectificarvoto($id)
    {
        $votacion = Pregunta::where('id', $id)->first();
        $tiempo_ini = $votacion->fechaComienzo;
        $tiempo_fin = $votacion->fechaFin;
        $date = date('Y-m-d H:i:s');

        if($date > $tiempo_ini && $date < $tiempo_fin)
        {
            if($votacion->esVinculante != true || $votacion->esRestringida != true)
            {
                //Para comprobar que un usuario ya ha votado o no
                $usuario = Session::get('idusuario');
                //Sacamos el id del usuario a partir del login de usuario
                $user = User::where('login', $usuario)->first();
                $iduser = $user->id;
                $opcion = 1000000;

                //Eliminamos las filas donde la opción sea 1000000 para que no haya problemas cuando busquemos la fila con la opción real
                Participacion::where('idusuario', $iduser)->where('idpregunta', $id)->where('opcion', $opcion)->delete();
                $p_rect = Participacion::where('idusuario', $iduser)->where('idpregunta', $id)->first();
                
                if($p_rect == null)
                {
                    return redirect()->route("accesovotaciones")->with('error','Usted aun no ha votado');
                }else
                {
                        //Sacamos las opciones para pasarselas a la vista
                        $json = $votacion->opciones;
                        $ops = json_decode($json, true);

                        $idopcion = $p_rect->opcion;
                        $rec = $votacion->recuento;
                        $opciones = json_decode($rec, true);
                        $opciones['votos'][$idopcion]--;

                        $s = json_encode($opciones);
                        $votacion->recuento = $s;
                        $votacion->save(); 

                        //Eliminamos la participación del usuario en esa votación para que el sistema nos deje votar
                        Participacion::where('idusuario', $iduser)->where('idpregunta', $id)->delete();

                        //Apuntamos que el usuario ha votado(la opción la apuntamos después)
                        $participacion = new Participacion;
                        $participacion->idusuario = $iduser;
                        $participacion->idpregunta = $id;
                        $participacion->opcion = 1000000;
                        $participacion->save();
                        return view('rectificar')->with('ops', $ops['opciones'])->with('id', $id)->with('pregunta', $votacion->titulo);
                }
            }else
            {
                return redirect()->route("accesovotaciones")->with('error','Esta votación no admite rectificar el voto');
            }
        }else
        {
            return redirect()->route("accesovotaciones")->with('error','Votación finalizada');
        }
    }
}