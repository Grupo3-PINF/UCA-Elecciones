<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;

use App\User;
use App\Rol;

class RolesController extends Controller
{
	public function view()
    {
        return view('roles');
    }

    public function mostrarRoles()
    {
        if(session_status()==PHP_SESSION_NONE)
            session_start();
        $array = "Sin roles";
        if(isset($_POST['login']) && !empty($_POST['login']))
        {
            $user = User::where('login',$_POST['login'])->first();
            if(isset($user))
            {
                Session::put('userselect',$user->identificador);
                $rol = Rol::where('idUser',$user->identificador)->first();
                if(isset($rol))
                {
                    $array = [];
                    if($rol->esAdmin)
                        array_push($array,'Administrador');
                    if($rol->esSecretario)
                        array_push($array,'Secretario');
                    if($rol->esEstudiante)
                        array_push($array,'Estudiante');
                    if($rol->esDesarrolladorBajo)
                        array_push($array,'Desarrollador Bajo');
                    if($rol->esDesarrolladorAlto)
                        array_push($array,'Desarrollador Alto');
                }
            }
        }
       return $array;
    }

    public function agregarRol()
    {
        if(session_status()==PHP_SESSION_NONE)
            session_start();
        if(isset($_POST['roles']) && !empty($_POST['roles']) && $_POST['roles'][1]!="")
        {
            if(Session::has('userselect'))
            {
                $id = Session::get('userselect');
                $roles = $_POST['roles'];
                if(array_search("Administrador",$roles)!=FALSE ||array_search("Secretario",$roles)!=FALSE 
                                || array_search("Estudiante",$roles)!=FALSE || array_search("Desarrollador Bajo",$roles)!=FALSE
                                || array_search("Desarrollador Alto",$roles)!=FALSE)
                {
                    $rolrow = Rol::where('idUser',$id)->first();
                    foreach($roles as $rol)
                    {
                        $rol = strtolower($rol);
                        if($rol == 'administrador')
                            $rolrow->esAdmin = true;
                        if($rol == 'secretario')
                            $rolrow->esSecretario = true;
                        if($rol == 'estudiante')
                            $rolrow->esEstudiante = true;
                        if($rol == 'desarrollador bajo')
                            $rolrow->esDesarrolladorBajo = true;
                        if($rol == 'desarrollador alto')
                            $rolrow->esDesarrolladorAlto = true;
                    }
                    $rolrow->save();
                    Session::forget('userselect');

                    return "Roles añadidos correctamente.";
                }
                else
                {
                    return "No hay ningún rol correcto.";
                }
            }
        }
        else
        {
            return "Rol no proporcionado.";
        }
    } 

    public function quitarRol()
    {
        if(session_status()==PHP_SESSION_NONE)
            session_start();
        if(isset($_POST['roles']) && !empty($_POST['roles']) && $_POST['roles'][1]!="")
        {
            if(Session::has('userselect'))
            {
                $id = Session::get('userselect');
                $roles = $_POST['roles'];
                if(array_search("Administrador",$roles)!=false ||array_search("Secretario",$roles)!=false 
                                || array_search("Estudiante",$roles)!=false || array_search("Desarrollador Bajo",$roles)!=false
                                || array_search("Desarrollador Alto",$roles)!=false)
                {
                    $rolrow = Rol::where('idUser',$id)->first();
                    foreach($roles as $rol)
                    {
                        $rol = strtolower($rol);
                        if($rol == 'administrador')
                            $rolrow->esAdmin = false;
                        if($rol == 'secretario')
                            $rolrow->esSecretario = false;
                        if($rol == 'estudiante')
                            $rolrow->esEstudiante = false;
                        if($rol == 'desarrollador bajo')
                            $rolrow->esDesarrolladorBajo = false;
                        if($rol == 'desarrollador alto')
                            $rolrow->esDesarrolladorAlto = false;
                    }
                    $rolrow->save();
                    Session::forget('userselect');

                    return "Roles eliminados correctamente.";
                }
                else
                {
                    return "No hay ningún rol correcto.";
                }
            }
        }
        else
        {
            return "Rol no proporcionado.";
        }
    }
    
    public function rolActivo()
    {
        if(session_status()==PHP_SESSION_NONE)
            session_start();
        if(isset($_POST['rol']) && !empty($_POST['rol']))
        { 
            if(Session::has('userselect'))
            {
                $id = Session::get('userselect');
                $rol = strtolower($_POST['rol']);
                if($rol=='administrador' || $rol=='secretario' || $rol=='desarrollador bajo'
                    || $rol=='desarrollador alto' || $rol=='estudiante')
                {
                    $roles = Rol::where('idUser',$id)->first();
                    $valor = true;

                    if($rol == 'administrador')
                        $valor = $roles->esAdmin;
                    if($rol == 'secretario')
                        $valor = $roles->esSecretario;
                    if($rol == 'estudiante')
                        $valor = $roles->esEstudiante;
                    if($rol == 'desarrollador bajo')
                        $valor = $roles->esDesarrolladorBajo;
                    if($rol == 'desarrollador alto')
                        $valor = $roles->esDesarrolladorAlto;
                    if($valor!=false)
                    {
                        $user = User::where('identificador',$id)->first();
                        $user->rolActivo=$rol;
                        $user->save();
                        return "Rol añadido correctamente";
                    }
                    else
                        return "El usuario no dispone de ese rol";
                }
                else
                {
                    return "Rol no válido";
                }
            }
        }
    }
}
