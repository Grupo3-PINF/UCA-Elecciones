<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;

use App\User;

class ResultadosController extends Controller
{
	public function view()
	{
		return view('resultados');
	}
}