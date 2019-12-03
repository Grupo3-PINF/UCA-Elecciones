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
		session_start(); 
		if(isset($_POST['opcionpregunta']) && !empty($_POST['opcionpregunta']))
		{
			$idvotacion = $_POST['opcionpregunta'];
			date_default_timezone_set('Europe/Madrid'); 
			$date = date('d/m/Y h:i:s a', time());
			$conn = $this->openCon();
			$resultados = Resultado::where('idVotacion', $idvotacion)->first();
			$votacion = Pregunta::find($idvotacion);
			$vector = ["OK" => 1,
				"opciones"=> "",
				"votos" => $resultados->recuento];
			$finalizada = true;
			if($votacion->esAnticipada == true)
			{
				if($date <= $votacion->fechaFinAnticipada)
				{
					$finalizada = false;
				}

			}
			else
			{
				if($date <= $votacion->fechaFin)
				{
					$finalizada = false;
				}
			}
			if($finalizada == false)
			{
				if($votacion->esTiempoReal == false)
				{
					$vector["OK"] = 0;
				}
				else 
				{
					if($votacion->seMuestraAntes == false)
					{
						$participaciones = Participacion::where('idpregunta', $idvotacion) -> pluck('idusuario');
						$participa = false;
						foreach ($participaciones as $participacion) 
						{
							if($participacion == $_SESSION['idusuario'])
							{
								$participa = true;
							}
						}
						if($participa == false)
						{ 
							$vector["OK"] = 0;
						}
					}	
				}
			}
			$this->closeCon($conn);
			return view('resultados')->with($vector);
		}
	}
	public function view()
	{
		return view('resultados');
	}
}
