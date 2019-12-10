<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;
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
		if(isset($_POST) && !empty($_POST))
		{
			$id = $_POST['id'];
			date_default_timezone_set('Europe/Madrid'); 
			$date = date('d/m/Y h:i:s a', time());
			$conn = $this->openCon();
			$resultados = Pregunta::where('id', $id)->first(); //cambiar esto para que se asgure de coger el recuento
			$votacion = Pregunta::find($id);
			$vector = ["OK" => 1];
			$vector = array_merge($vector,json_decode($resultados->opciones,true));
			$vector = array_merge($vector,json_decode($resultados->recuento,true));
			//hay que sacar también el título de la pregunta para que la puedan mostrar en el chart
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
						$participaciones = Participacion::where('idpregunta', $id) -> pluck('idusuario');
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
			/*if($vector["OK"] == 0)
			{
				$vector["votos"] = 0;
				$vector["opciones"] = 0;
			}*/
			$vector["OK"] == 1;
			//dd($vector['votos']);
			//$vector['OK'] = 1;
			//$vector['opciones'] = ["culo", "caca", "pis"]; // lineas de prueba
			//($vector['votos'] = [450,200,300];
			return $vector;
		}
	}
	public function view()
	{
		return view('resultados');
	}
}