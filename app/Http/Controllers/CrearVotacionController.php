<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;

use App\User;

class CrearVotacionController extends Controller
{
	public function view()
    {
        return view('crearvotacion');
    }

    public function crearVotacion()
    {
       //$_POST['tipo'] etc...preguntadme (Adri)
    	return view('crearvotacion');
    }
}