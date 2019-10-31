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
}