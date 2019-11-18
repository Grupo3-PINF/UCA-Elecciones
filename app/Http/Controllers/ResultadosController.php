<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;
use App\Resultado;
use App\Pregunta;
use App\User;

class ResultadosController extends Controller
{
	public function mostrarResultado($idvotacion)
	{
		$conn = openCon();
		$resultados = Resultado::where('idVotacion', $idvotacion)->first();
		$votacion = Pregunta::find($idvotacion);
		

		closeCon($conn);
	}
	public function view()
	{
		$votacion = Resultado::find(1);
		return view('resultados')->with("votacion",$votacion);
	}
	
	function openCon()
	{
		$dbhost = "localhost";
		$dbuser = "root";
		$db = "laravel";
		$conn  =  new mysql_connect($dbhost,$dbuser,$db) or die("Connect failed: %s\n". $conn -> error);
		return $conn;
	}
	function closeCon($conn)
	{
		$conn -> close();
	}
	
}
?>