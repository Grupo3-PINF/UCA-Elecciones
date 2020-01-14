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
use DateTime;

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
			$date = microtime();
			$conn = $this->openCon();
			$resultados = Pregunta::where('id', $id)->first(); //cambiar esto para que se asgure de coger el recuento
			$votacion = Pregunta::find($id);
			$ffin = Pregunta::where('id', $id)->value('fechaFin');
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
			$participaciones = Participacion::where('idpregunta', $id)->pluck('idusuario');
			$participa = false;
			$us = User::where('login',Session::get('idusuario'))->value('identificador');
			foreach ($participaciones as $participacion) 
			{
				//var_dump($participacion, intval($us));
				if($participacion == intval($us))
				{
					$participa = true;
				}
			}	
			//comprobaciones
			if($date <= strtotime($ffin)) //si la votación no ha finalizado
			{
				if($votacion->esTiempoReal == false) //si no es en tiempo real F
				{
					$vector['OK'] = 0;
				}	
				//fin t real muestra antes
				if($votacion->seMuestraAntes == false)
				{
					if($participa == false) //si no ha participado F
					{ 
						$vector["OK"] = 0;
					}
				}
			}
			if($votacion->esRestringida == true && $participa ==false) 
				$vector["OK"] = 0;
			
			$this->closeCon($conn);
			return $vector;
		}
	}
	public function view()
	{
		$preguntas = Pregunta::all();
		return view('resultados')->with("preguntas",$preguntas);
	}
}