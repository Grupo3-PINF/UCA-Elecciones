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
        if(isset($_SESSION['idusuario']) && !empty($_SESSION['idusuario']))
        {
            $login = $_SESSION['idusuario'];
            $user = User::where('login',$login)->first();
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
}