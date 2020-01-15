<?php $titulo = "Crear votacion"; ?>

@extends('layouts/layout')
@section('content')
<div id="crearvotacion">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>PREGUNTAS, ELECCIONES Y CONSULTAS</h3>
				<p>VotUCA es una herramienta intuitiva desarrollada con el fin de facilitar la creación de procesos electorales, digitalizando las votaciones y eliminando la necesidad de un escrutinio manual.</p>
			</div>
		</div>
		@if(!@isset($mensaje))
		<!--<form action="{{url('/crearvotacion')}}" method='POST'> 
		@csrf -->
		<div class="helper">
			<div class="step-1 row">
				<div class="col-12 col-md-4">
					<div id="crear-pregunta" class="votacion" onclick="mostrarProceso('pregunta');">
						<h4>Preguntas</h4>
						<i class="far fa-question-circle"></i>
						<p>Crea una votación de carácter genérico en la que los votantes deciden sobre un asunto de cualquier índole.</p>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div id="crear-eleccion" class="votacion" onclick="mostrarProceso('eleccion');">
						<h4>Elecciones</h4>
						<i class="fas fa-graduation-cap"></i>
						<p>Crea una votación en la que los participantes pueden elegir a un candidato de entre los que se han presentado.</p>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div id="crear-consulta" class="votacion" onclick="mostrarProceso('consulta');">
						<h4>Consultas</h4>
						<i class="far fa-envelope"></i>
						<p>Crea una pregunta o una elección a modo de sondeo para conocer la opinión de los votantes sobre un tema.</p>
					</div>
				</div>
			</div>
			@include('crearvotacion/crearpregunta')
			@include('crearvotacion/creareleccion')
			@include('crearvotacion/crearconsulta')
		</div>
		<!--</form> -->
		@else
		<div class="row">
			<div class="col-12">
				<div class="alert alert-success">
					<h4>{{$mensaje ? : ''}}</h4>
				</div>
			</div>
		</div>
	@endif
	</div>
</div>
<script>
	function consultaPregunta() {
		mostrarProceso('pregunta', true);
		let chTiempoReal = document.getElementById("tiempo-real-pregunta");
		chTiempoReal.checked = true;

		let chSecreta = document.getElementById("secreta-pregunta");
		chSecreta.checked = false;
		chSecreta.disabled = true;
		chSecreta.style = "cursor: not-allowed;";
	}

	function consultaEleccion() {
		mostrarProceso('eleccion', true);
		let chTiempoReal = document.getElementById("tiempo-real-eleccion");
		chTiempoReal.checked = true;

		let chSecreta = document.getElementById("secreta-eleccion");
		chSecreta.checked = false;
		chSecreta.disabled = true;
		chSecreta.style = "cursor: not-allowed;";
	}

	function consulta() {
		let tipo = document.getElementById("tipo-consulta");
		if (tipo.value === "pregunta") {
			consultaPregunta();
		} else if (tipo.value === "eleccion") {
			consultaEleccion();
		}
	}

	function mostrarProceso(tipo, deConsulta) {
		$.ajax({
			type: 'POST',
			url: "crearvotacion/seleccionVotacion",
			data: {
				"_token": "{{ csrf_token() }}",
				"tipoVotacion": tipo
			},
			success: function(response) {
				switch(response.tipo) {
					case "pregunta":
						onload = recibirGruposPregunta();
						$("#steps-eleccion").remove();
						$("#steps-consulta").remove();
						if (!deConsulta) {
							let ch = document.getElementById("tiempo-real-pregunta");
							ch.checked = false;
							ch.parentElement.hidden = true;
						}
					break;
					case "eleccion":
						onload = recibirGruposEleccion();
						onload = recibirCandidatos();
						$("#steps-pregunta").remove();
						$("#steps-consulta").remove();
						if (!deConsulta) {
							let ch = document.getElementById("tiempo-real-eleccion");
							ch.checked = false;
							ch.parentElement.hidden = true;
						}
					break;
				}
				
				$(".step-1").hide();
				$("#steps-" + response.tipo).toggleClass("hide").delay(1200);
				$("#steps-" + response.tipo).addClass("flex").delay(1200)
			},
			error: function(error) {
				console.error(error)
			}
		})
	}
</script>
@stop