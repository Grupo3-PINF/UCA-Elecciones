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
	public function mostrarResultado($idvotacion)
	{
		$conn = openCon();

	}
	public function view()
	{
		return view('resultados');
	}
	
	function openCon()
	{
		$dbhost = "localhost";
		$dbuser = "root";
		$db = "bdpinf";
		$conn  =  new mysql_connect($dbhost,$dbuser,$db) or die("Connect failed: %s\n". $conn -> error);
		return $conn;
	}
	function CloseCon($conn)
	{
		$conn -> close();
	}
	
}
?>