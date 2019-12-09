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
        $array = null;
        if(isset($_POST['login']) && !empty($_POST['login']))
        {
            $user = User::where('login',$_POST['login'])->first();
            
            if(isset($user))
            {
                $_SESSION['userselect']=$user->identificador;
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
            if(isset($_SESSION['userselect']) && !empty($_SESSION['userselect']))
            {
                $roles = $_POST['roles'];
                if(array_search("Administrador",$roles)!=FALSE ||array_search("Secretario",$roles)!=FALSE 
                                || array_search("Estudiante",$roles)!=FALSE || array_search("Desarrollador Bajo",$roles)!=FALSE
                                || array_search("Desarrollador Alto",$roles)!=FALSE)
                {
                    $id = $_SESSION['userselect'];
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
                    unset($_SESSION['userselect']);

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
            if(isset($_SESSION['userselect']) && !empty($_SESSION['userselect']))
            {
                $roles = $_POST['roles'];
                if(array_search("Administrador",$roles)!=false ||array_search("Secretario",$roles)!=false 
                                || array_search("Estudiante",$roles)!=false || array_search("Desarrollador Bajo",$roles)!=false
                                || array_search("Desarrollador Alto",$roles)!=false)
                {
                    $id = $_SESSION['userselect'];
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
                    unset($_SESSION['userselect']);

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
}
