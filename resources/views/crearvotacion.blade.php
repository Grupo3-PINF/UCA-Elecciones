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
			<form action="{{url('/crearvotacion')}}" method='POST'>
			@csrf
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
<<<<<<< HEAD
				<div id="pregunta-basica-div" class="step-5 row hide">
					<div class="col-12">
						<h4>¿Cuál es la pregunta?</h4>
					</div>
					<div class="col-12">
						<label>Introduzca su pregunta</label>
					</div>
					<div class="col-12">
						<textarea type="text" name="pregunta-basica" placeholder="Introduzca su pregunta"></textarea>
					</div>
				<input type="hidden" id="eleccion-1" value="0" name="eleccion-1">
				<input type="hidden" id="eleccion-2" value="0" name="eleccion-2">
				<input type="hidden" id="eleccion-3" value="0" name="eleccion-3">
				<input type="hidden" id="eleccion-4" value="0" name="eleccion-4">
				<input type="hidden" id="eleccion-5" value="0" name="eleccion-5">
					<div class="col-12">
						<button class="btn btn-primary" type="submit">Enviar</a>
					</div>
				</div>
			</div>
			</form>
		</div>
		@isset($mensaje)
=======
		</form>
		@else
>>>>>>> 1d6039e481bc6797959beb15b7e1541ef32bfc7d
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

	function anadirGrupos() {
		$('#button-groups').click(function(){
			var nombre = $('select[name=grupos-pregunta]').text();
			var id = $('select[name=grupos-pregunta]').val();
			var html = '<input class="input-div-caja" type="text" name="grupo-' + id + '" placeholder="' + id +'"><a name="borrar-' + id + '" onclick="borrarInput(\'' + id + '\',\'grupo\')"><i class="fas fa-window-close"></i></a>';
			if(!$("#grupos-div-pregunta input[name=grupo-" + id + "]").length)
				$('#grupos-div-pregunta').append(html);
		});
	}

	function anadirGruposElecciones() {
		$('#button-groups-elecciones').click(function(){
			var nombre = $('select[name=grupos-eleccion]').text();
			var id = $('select[name=grupos-eleccion]').val();
			var html = '<input class="input-div-caja" type="text" name="grupo-' + id + '" placeholder="' + id +'"><a name="borrar-' + id + '" onclick="borrarInput(\'' + id + '\',\'grupo\')"><i class="fas fa-window-close"></i></a>';
			if(!$("#grupos-div-eleccion input[name=grupo-" + id + "]").length)
				$('#grupos-div-eleccion').append(html);
		});
	}

	function anadirCandidatos() {
		$('#button-candidatos').click(function(){
			var nombre = $('select[name=candidatos-eleccion]').text();
			var id = $('select[name=candidatos-eleccion]').val();
			var html = '<input class="input-div-caja" type="text" name="candidato-' + id + '" placeholder="' + id +'"><a name="borrar-' + id + '" onclick="borrarInput(\'' + id + '\',\'candidato\')"><i class="fas fa-window-close"></i></a>';
			if(!$("#candidatos-div-eleccion input[name=candidato-" + id + "]").length)
				$('#candidatos-div-eleccion').append(html);
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
				switch(response.tipo) {
					case "pregunta":
						$("#steps-eleccion").remove();
						$("#steps-consulta").remove();
					break;
					case "eleccion":
						$("#steps-pregunta").remove();
						$("#steps-consulta").remove();
					break;

					case "consulta":
						$("#steps-eleccion").remove();
						$("#steps-pregunta").remove();
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