<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;
use App\Resultado;
use App\Pregunta;
use App\Participacion;
use App\User;

class ResultadosController extends Controller
{

	public function openCon()
	{
		$dbhost = "localhost";
		$dbuser = "root";
		$db = "laravel";
		$password = "";
		$conn  =  mysqli_connect($dbhost,$dbuser,$password,$db) or die("Connect failed: %s\n". $conn -> error);
		return $conn;
	}
	
	public function closeCon($conn)
	{
		$conn -> close();
	}

	public function mostrarResultado()
	{
		if(isset($_POST['opcionpregunta']) && !empty($_POST['opcionpregunta']))
		{
			$idvotacion = $_POST['opcionpregunta'];
			date_default_timezone_set('Europe/Madrid'); 
			$date = date('d/m/Y h:i:s a', time());
			$conn = $this->openCon();
			$resultados = Resultado::where('idVotacion', $idvotacion)->first();
			$votacion = Pregunta::find($idvotacion);
			/*
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
			$participaciones = Participacion::where('idpregunta', $idvotacion) -> pluck('idusuario');
			$participa = false;
			foreach ($participaciones as $participacion) {
				if($participacion == $idusuario)
				{
					$participa = true;
				}
			}
			if($participa)
			{	
				if(!$votacion->esTiempoReal)
				{
					$votacion->recuento = 0;
				}
			}
			else 
			{
				if(!$votacion->seMuestraAntes)
				{
					$votacion->recuento = 0;
				}
				
			}*/
			$this->closeCon($conn);
			json_encode(['OK' => 1, 'array_votacion' => "HOLAAA"]);
			return view('resultados')->with('array_votacion', "HOLAA");
		}
	}
	public function view()
	{
		//$votacion = Resultado::find(1);
		/*$participaciones = Participacion::where('idpregunta', 1) -> pluck('idusuario');
		$participa = 100;
		foreach ($participaciones as $participacion) {
			if($participacion == 13)
			{
				$participa = 200;
			}
		}*/
		return view('resultados');
	}
}
