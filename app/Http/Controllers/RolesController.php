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

    public function mostrarRoles($login)
    {
        if(session_status()==PHP_SESSION_NONE)
            session_start();
        
        $user = User::where('login',$login)->first();
        $array = null;
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
        return view('roles')->with('roles',$array);
    }

    public function añadirRol($roles)
    {
        if(session_status()==PHP_SESSION_NONE)
            session_start();
        if(isset($_SESSION['userselect']) && !isempty($_SESSION['userselect']))
        {
            $id = $_SESSION['userselect'];
            $rol = Rol::where('idUser',$id)->first();
            foreach($roles as $rol)
            {
                if($rol == 'Administrador')
                    $rol->esAdmin = true;
                if($rol == 'Secretario')
                    $rol->esSecretario = true;
                if($rol == 'Estudiante')
                    $rol->esEstudiante = true;
                if($rol == 'Desarrollador Bajo')
                    $rol->esDesarrolladorBajo = true;
                if($rol == 'Desarrollador Alto')
                    $rol->esDesarrolladorAlto = true;
            }
            $rol->save();
            unset($_SESSION['userselect']);
        }

        return "Roles añadidos correctamente";
    }

    public function quitarRol()
    {
        if(session_status()==PHP_SESSION_NONE)
            session_start();
        if(isset($_SESSION['userselect']) && !isempty($_SESSION['userselect']))
        {
            $id = $_SESSION['userselect'];
            $rol = Rol::where('idUser',$id)->first();
            foreach($roles as $rol)
            {
                if($rol == 'Administrador')
                    $rol->esAdmin = false;
                if($rol == 'Secretario')
                    $rol->esSecretario = false;
                if($rol == 'Estudiante')
                    $rol->esEstudiante = false;
                if($rol == 'Desarrollador Bajo')
                    $rol->esDesarrolladorBajo = false;
                if($rol == 'Desarrollador Alto')
                    $rol->esDesarrolladorAlto = false;
            }
            $rol->save();
            unset($_SESSION['userselect']);
        }

        return "Roles eliminados correctamente";
} 
    }
}