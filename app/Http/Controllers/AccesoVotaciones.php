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
use App\CensosUsuario;
use App\ParticipacionElecciones;

class AccesoVotaciones extends Controller
{
    public function index()
    {
        //Sacamos el id del usuario a partir del login de usuario y de ahí sacamos al censo al que pertenece
        $usuario = Session::get('idusuario');
        $user = User::where('login', $usuario)->first();
        $id_user = $user->id;
        $censo_user = CensosUsuario::where('idUsuario', $id_user)->first();

        if($censo_user != null)
        {
            $id_censo_user = $censo_user->idCenso;
        }
        //Hacer 3 grupos: las preguntas que se pueden rectificar, las que no y las elecciones
        //para que así rectificar sólo salgan a las que puedan
        //Preguntas
        $preguntas = Pregunta::all();
        $date = date('Y-m-d H:i:s');
        $array_rec = [];
        $array_norec = [];
        foreach($preguntas as $p)
        {
            //Comprobar que el usuario tiene acceso a la votacion
            $censos_json = $p->censoVotante;
            $acceso = true;
            if($censos_json != null && $censo_user != null)
            {
                $censos = json_decode($censos_json, true);
                $acceso = false;
                foreach($censos['censos'] as $key)
                {
                    if($key == $id_censo_user)
                    {
                        $acceso = true;
                    }
                }
            }
            if($date > $p->fechaComienzo && $date < $p->fechaFin && $acceso == true)
            {
                //Votación rectificable
                if($p->esVinculante == false || $p->esRestringida == false)
                {
                    array_push($array_rec,$p);
                }else
                {
                    array_push($array_norec,$p);
                }
            }
        }
        //Elecciones
        $elecciones = Eleccion::all();
        $date = date('Y-m-d H:i:s');
        $array_el = [];
        foreach($elecciones as $e)
        {
            if($date > $e->fechaInicio && $date < $e->fechaFin)
                array_push($array_el,$e);
        }
        return view('accesovotaciones')->with('pr', $array_rec)->with('pnr', $array_norec)->with('elecciones', $elecciones);
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
            //Comprobar que el usuario tiene acceso a la pregunta
            $censo_user = CensosUsuario::where('idUsuario', $iduser)->first();
            if($censo_user != null)
            {
                $id_censo_user = $censo_user->idCenso;
            }
            $censos_json = $votacion->censoVotante;
            $acceso = true;
            if($censos_json != null && $censo_user != null)
            {
                $censos = json_decode($censos_json, true);
                $acceso = false;
                foreach($censos['censos'] as $key)
                {
                    if($key == $id_censo_user)
                    {
                        $acceso = true;
                    }
                }
            }
            if($acceso == true)
            {
                $date = date('Y-m-d H:i:s');
                $tiempo_ini = $votacion->fechaComienzo;
                $tiempo_fin = $votacion->fechaFin;

                if($date > $tiempo_ini && $date < $tiempo_fin)
                {
                    $json = $votacion->opciones;
                    $ops = json_decode($json, true);
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
            }else
            {
                return redirect()->route("accesovotaciones")->with('error','No tienes acceso a esta pregunta');
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

            //Si no es 1000000 es que ha retrocedido la página e intenta votar otra vez
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
    }
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
                    //Decrementamos la opción a la que votó antes
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
    public function enviar_elecciones($id)
    {
        //Para comprobar que un usuario ya ha votado o no
        $usuario = Session::get('idusuario');
        //Sacamos el id del usuario a partir del login de usuario
        $user = User::where('login', $usuario)->first();
        $iduser = $user->id;
        $votado = ParticipacionElecciones::where('idusuario', $iduser)->where('idpregunta', $id)->first();

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
            $eleccion = Eleccion::find($id);
            $date = date('Y-m-d H:i:s');
            $tiempo_ini = $eleccion->fechaInicio;
            $tiempo_fin = $eleccion->fechaFin;

            if($date > $tiempo_ini && $date < $tiempo_fin)
            {
                $json = $eleccion->candidatos;
                $candidatos = json_decode($json, true);
                //Apuntamos que el usuario ha votado(la opción la apuntamos después)
                $participacion = new ParticipacionElecciones;
                $participacion->idusuario = $iduser;
                $participacion->idpregunta = $id;
                $participacion->opcion = 1000000;
                $participacion->save();

                return view('opciones_eleccion')->with('candidatos', $candidatos['candidatos'])->with('id', $id)->with('pregunta', $eleccion->titulo);
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
    public function guardaropcion_elecciones()
    {
        if(isset($_POST['respuesta']) && !empty($_POST['respuesta']))
        {
            $votacion = $_POST['respuesta'];
            $limite = '.';
            
            //Separamos la cadena recibida que contiene el id de la elección y el id del candidato
            $ops = explode($limite, $votacion);
            $candidato = $ops[0];
            $id = $ops[1];

            //Registrar el usuario como que ya ha votado a dicha elección y comprobar que no vota más de 1 vez
            $usuario = Session::get('idusuario');
            //Sacamos el id del usuario a partir del login de usuario
            $user = User::where('login', $usuario)->first();
            $iduser = $user->id;
            //Buscamos la fila en la base de datos Participación que coincida con el usuario y pregunta
            $votado = ParticipacionElecciones::where('idpregunta', '=', $id)->where('idusuario', '=', $iduser)->first();

            //Si no es 1000000 es que ha retrocedido la página e intenta votar otra vez
            if($votado->opcion == 1000000)
            {
                $eleccion = Eleccion::find($id);
                $date = date('Y-m-d H:i:s');
                $tiempo_ini = $eleccion->fechaInicio;
                $tiempo_fin = $eleccion->fechaFin;

                if($date > $tiempo_ini && $date < $tiempo_fin)
                {
                    $votado->opcion = $candidato;
                    $votado->save();

                    $rec = $eleccion->recuento;
                    $opciones = json_decode($rec, true);
                    $opciones['votos'][$candidato]++;

                    $s = json_encode($opciones);
                    $eleccion->recuento = $s;
                    $eleccion->save();

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
}