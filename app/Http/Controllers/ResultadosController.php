<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Session;
use Auth;
use App\Pregunta;
use App\Eleccion;
use App\Participacion;
use App\ParticipacionElecciones;
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
			if(strpos($_POST['id'],"e")==null)
			{
				$resultados = Pregunta::where('id', $id)->first(); //cambiar esto para que se asgure de coger el recuento
				$votacion = Pregunta::find($id);
				$vector = ["OK" => 1,
					"titulo" => $resultados->titulo
				];
				$vector = array_merge($vector,json_decode($resultados->opciones,true));
				if(json_decode($resultados->recuento,true)==null)
				{
					$resultados->recuento=["votos"=>[0,0,0]];
					$vector = array_merge($vector,$resultados->recuento);
				}
				else{
					$vector = array_merge($vector,json_decode($resultados->recuento,true));
				}
			}
			else
			{
				$id = substr($id,0,strlen($id)-1);
				$resultados = Eleccion::where('id', $id)->first(); //cambiar esto para que se asgure de coger el recuento
				$votacion = Eleccion::find($id);
				$vector = ["OK" => 1,
					"titulo" => $resultados->titulo
				];
				$candidatos = json_decode($resultados->candidatos,true);
				$array = $candidatos["candidatos"];
				$prueba=["opciones"=>$array];
				echo var_dump($prueba);
				$vector = array_merge($vector,$prueba);
				if(json_decode($resultados->recuento,true)==null)
				{
					$resultados->recuento=["votos"=>[0,0,0]];
					$vector = array_merge($vector,$resultados->recuento);
				}
				else{
					$vector = array_merge($vector,json_decode($resultados->recuento,true));
				}
			}			
				$this->closeCon($conn);
				$vector["OK"] == 1;
				return $vector;
		}
}

	public function view()
	{
		$date = date('d/m/Y h:i:s a', time());
		$preguntas = Pregunta::all();
		foreach($preguntas as $key => $votacion)
		{
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
					unset($preguntas[$key]);
				}
				else 
				{
					if($votacion->seMuestraAntes == false)
					{
						$participaciones = Participacion::where('idpregunta', $votacion->id) -> pluck('idusuario');
						$participa = false;
						foreach ($participaciones as $participacion) 
						{
							if($participacion == Session::get('idusuario'))
							{
								$participa = true;
							}
						}
						if($participa == false)
						{ 
							unset($preguntas[$key]);
						}
					}	
				}
			}
		}
		$elecciones = Eleccion::all();
		foreach($elecciones as $key => $votacion)
		{
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
					unset($elecciones[$key]);
				}
				else 
				{
					$participaciones = ParticipacionElecciones::where('idpregunta', $votacion->id) -> pluck('idusuario');
					$participa = false;
					foreach ($participaciones as $participacion) 
					{
						if($participacion == Session::get('idusuario'))
						{
							$participa = true;
						}
					}
					if($participa == false)
					{ 
						unset($elecciones[$key]);
					}
				}
			}
		}


		return view('resultados')->with("preguntas",$preguntas)->with("elecciones",$elecciones);
	}
}