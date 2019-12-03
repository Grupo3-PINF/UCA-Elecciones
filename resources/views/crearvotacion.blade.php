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
		</form>
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
		$("#crear-"+tipo).click(function(){
  			$(".step-1").hide(1200);
  			$("#steps-"+tipo).addClass("flex").delay(1200).queue(function(){
    			$(this).removeClass("hide").dequeue();
			});
  		});
	}
	
</script>
@stop