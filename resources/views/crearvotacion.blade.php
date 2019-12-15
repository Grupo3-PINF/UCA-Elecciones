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
	$('input[name="anticipada-pregunta"]').click(function(){
		if($('input[name="anticipada-pregunta"]').prop('checked')) {
			$('#fecha-anticipada-pregunta').show();
			$('#participantes-anticipada-pregunta').show();
		} else {
			$('#fecha-anticipada-pregunta').hide();
			$('#participantes-anticipada-pregunta').hide();
		}	
	});

	function recibirGrupos() {
		$.ajax({
			type: 'POST',
			url: "crearvotacion/recibirGrupos",
			data: {
				"_token": "{{ csrf_token() }}",
			},
			success: function(response) {
				var grupos = response.grupos;
				for (var i = 0; i < grupos.length; i++) {
					if (typeof grupos[i] != "undefined") {
						console.log(grupos[i].nombre);
						var nombre = grupos[i].nombre;
						var id = grupos[i].id;
						var html = '<option value="' + id + '">' + nombre + '</option>';
						$('select[name=grupos-eleccion]').append(html);
					}
				}
			},
			error: function(error) {
				console.error(error)
			}
		})
	}

	function anadirGrupos() {
		$('#button-groups').click(function(){
			var nombre = $('select[name=grupos-pregunta]').text();
			var id = $('select[name=grupos-pregunta]').val();
			var html = '<input class="input-div-caja" type="text" name="grupo-' + id + '" placeholder="' + id +'"><a name="borrar-' + id + '" onclick="borrarInput(\'' + id + '\',\'grupo\')"><i class="fas fa-window-close"></i></a>';
			if(!$("#grupos-div-pregunta input[name=grupo-" + id + "]").length)
				$('#grupos-div-pregunta').append(html);
		});
	}

	function borrarInput(nombre, tipo) {
		$('input[name=' + tipo + '-' + nombre + ']').remove();
		$('a[name=borrar-' + nombre + ']').remove();
	}

	function mostrarProceso(tipo) {
		$.ajax({
			type: 'POST',
			url: "crearvotacion/seleccionVotacion",
			data: {
				"_token": "{{ csrf_token() }}",
				"tipoVotacion": tipo
			},
			success: function(response) {
				//Revision de codigo
				$(".step-1").hide();
				switch(response.tipo) {
					case "pregunta":
						$("#steps-eleccion").remove();
						$("#steps-consulta").remove();
						$("#steps-pregunta").toggleClass("hide").delay(1200);
						$("#steps-pregunta").addClass("flex").delay(1200)
					break;
					case "eleccion":
						onload = recibirGrupos();
						$("#steps-pregunta").remove();
						$("#steps-consulta").remove();
						$("#steps-eleccion").toggleClass("hide").delay(1200);
						$("#steps-eleccion").addClass("flex").delay(1200)
					break;

					case "consulta":
						$("#steps-eleccion").remove();
						$("#steps-pregunta").remove();
						$("#steps-consulta").toggleClass("hide").delay(1200);
						$("#steps-consulta").addClass("flex").delay(1200)
					break;
				}
			},
			error: function(error) {
				console.error(error)
			}
		})
	}
</script>
@stop