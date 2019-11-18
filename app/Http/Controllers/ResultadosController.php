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
		date_default_timezone_set('Europe/Spain');
		$date = date('d/m/Y h:i:s a', time());
		$conn = openCon();
		$resultados = Resultado::where('idVotacion', $idvotacion)->first();
		$votacion = Pregunta::find($idvotacion);
		if($votacion->esAnticipada == true)
		{
			if($date >= $votacion->fechaFinAnticipada)
			{
				return $votacion->recuento;
			}

		}
		else
		{
			if($date >= $votacion->fechaFin)
			{
				return $votacion->recuento;
			}
		}
		if(/*si el usuario no ha votado (hay que hacerle la puta tabla de los cojones)*/)
		{	
			if($votacion->seMuestraAntes)
			{
				return $votacion->recuento;
			}
			else
			{
				return 0;
			}
		}
		else 
		{
			if($votacion->esTiempoReal)
			{
				return $votacion->recuento;
			}
			else
			{
				return 0;
			}
		}
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