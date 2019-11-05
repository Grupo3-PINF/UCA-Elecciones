<?php namespace UCA\Http\Controllers;

use Auth;
use Redirect;
use Session;

class LoginController extends Controller {

	public function index()
  	{
    	return view('login');
  	}

 	public function logout()
  	{
	    Auth::logout();
	    return Redirect::to('login');
  	}

  	public function login()
  	{
  		if(isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password']))
  		{
  			$username = $_POST['username'];
  			$password = $_POST['password'];
  			$user = User::where('username',$username)->where('password',$password)->first();
  			if($user)
  			{
  				Auth::login($user);
  				Redirect::to('index');
  			}
  			//unset($_SESSION['usernotfound']);
  		} else {
  			$mensaje = "El usuario o la contraseña son erróneos";
  			//$_SESSION['usernotfound'] = $mensaje;
  			//O
  			//Session::flash('message',$mensaje);
  			//O
  			return Redirect::to('login')->with('mensaje',$mensaje);
  		}
  	}
}