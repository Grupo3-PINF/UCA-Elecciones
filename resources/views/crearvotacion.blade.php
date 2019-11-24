<?php $titulo = "Crear votacion"; ?>
@extends('layouts/layout')
@section('content')
<div id="crearvotacion">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>PREGUNTAS, ELECCIONES Y CONSULTAS</h3>
				<p>VotUCA es una herramienta intuitiva desarrollada con el fin de facilitar la creación de procesos electorales, digitalizando las votaciones y eliminando la necesidad de un escrutinio manual. El futuro es ahora.</p>
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
								<p>Texto a aclarar con el equipo de análisis o diseño para especificar qué hace este apartado.</p>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div id="crear-eleccion" class="votacion" onclick="mostrarProceso('eleccion');">
								<h4>Elecciones</h4>
								<i class="fas fa-graduation-cap"></i>
								<p>Texto a aclarar con el equipo de análisis o diseño para especificar qué hace este apartado.</p>
							</div>
						</div>
						<div class="col-12 col-md-4">
							<div id="crear-consulta" class="votacion" onclick="mostrarProceso('consulta');">
								<h4>Consultas</h4>
								<i class="far fa-envelope"></i>
								<p>Texto a aclarar con el equipo de análisis o diseño para especificar qué hace este apartado.</p>
							</div>
						</div>
					</div>
					<div id="steps-pregunta" class="hide">
						<div class="row">
							<div class="col-12">
								<h4>Pregunta</h4>
								<div class="form-group">
									<label>Título</label>
									<input class="form-control" type="text" name="titulo-pregunta" placeholder="Ponga título a su pregunta">
								</div>
								<div class="form-group">
									<label>Simple o compleja</label>
									<select class="form-control" name="tipo-pregunta">
										<option value="1">Simple</option>
										<option value="2">Compleja</option>
									</select>
								</div>
								<div class="form-group">
									<label>Grupos con permiso para votar</label>
									<select class="form-control" name="grupos-pregunta">
										<option value="alumnos">Alumnos</option>
										<option value="profesores">Profesores</option>
										<option value="todos">Todos</option>
									</select>
								</div>
								<div class="form-group">
									<label>Fecha de la votación</label>
									<input class="form-control" type="date" name="fecha-pregunta">
								</div>
								<div class="form-group">
									<label>Votación anticipada</label>
									<input type="checkbox" name="anticipada-pregunta">
								</div>
								<div class="form-group">
									<label>Tiempo de votación (minutos)</label>
									<input class="form-control" type="number" value="1">
								</div>
								<div class="form-group">
									<label>Votación secreta</label>
									<input type="checkbox" name="secreta-pregunta">
								</div>
								<div class="form-group">
									<button class="btn btn-primary" type="submit">Enviar</button>
									<a href="{{url('/crearvotacion')}}">Cancelar</a>
								</div>
							</div>
						</div>
					</div>
					<div id="steps-eleccion" class="hide">
						<div class="row">
							<div class="col-12">
								<h4>Elección</h4>
								<div class="form-group">
									<label>Título</label>
									<input class="form-control" type="text" name="titulo-eleccion" placeholder="Ponga título a su elección">
								</div>
								<div class="form-group">
									<label>Candidatos para la elección</label>
									<input type="text" class="form-control" name="candidatos-eleccion" placeholder="Nombre y apellidos">
								</div>
								<div class="form-group">
									<label>Fecha de la elección</label>
									<input class="form-control" type="date" name="fecha-eleccion">
								</div>
								<div class="form-group">
									<label>Grupos participantes</label>
									<select class="form-control" name="grupos-eleccion">
										<option value="alumnos">Alumnos</option>
										<option value="profesores">Profesores</option>
										<option value="todos">Todos</option>
									</select>
								</div>
								<div class="form-group">
									<label>Tipo de elección</label>
									<select class="form-control" name="tipo-eleccion">
										<option value="1" selected="true">Delegados</option>
										<option value="2">Grupos no ponderados</option>
										<option value="3">Cargos unipersonales</option>
									</select>
								</div>
								<div class="form-group">
									<button class="btn btn-primary" type="submit">Enviar</button>
									<a href="{{url('/crearvotacion')}}">Cancelar</a>
								</div>
							</div>
						</div>
					</div>
					<div id="steps-consulta" class="hide">
						<div class="row">
							<div class="col-12">
								<h4>Consulta</h4>
								<div class="form-group">
									<label>Tiempo real</label>
									<input type="checkbox" name="tiempo-consulta">
								</div>
								<div class="form-group">
									<label>Tipo de consulta</label>
									<select class="form-control" name="tipo-consulta">
										<option value="pregunta">Pregunta</option>
										<option value="eleccion">Eleccion</option>
									</select>
								</div>
								<div class="form-group">
									<button class="btn btn-primary" type="submit">Enviar</button>
									<a href="{{url('/crearvotacion')}}">Cancelar</a>
								</div>
							</div>
						</div>
					</div>
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
	function mostrarProceso(tipo) {
		$("#crear-"+tipo).click(function(){
  			$(".step-1").hide(1200);
  			$("#steps-"+tipo).addClass("flex").delay(1200).queue(function(){
    			$(this).removeClass("hide").dequeue();
			});
  		});
	}
	
	function enviarVotacion() {
		var eleccion1 = $('#eleccion-1').val();
		var eleccion2 = $('#eleccion-2').val();
		var eleccion3 = $('#eleccion-3').val();
		var eleccion4 = $('#eleccion-4').val();
		var eleccion5 = $('#eleccion-5').val();

		var token = $('meta[name=csrf-token]').attr('content');
		var titulo = $('textarea#titulo-pregunta').val();

		$.ajaxSetup({
    		headers: {
        		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    		}
		});

	    $.ajax ({
	      'url': 'crearvotacion',
	      'type': 'POST',
	      'dataType': 'json',
	      'data' : 
	      	{
				  titulo: titulo,
				  eleccion1 : eleccion1,
				  eleccion2: eleccion2,
				  eleccion3: eleccion3,
				  eleccion4: eleccion4,
				  eleccion5: eleccion5
				  },
	      'success': function (json) {
	        if(json.ok == 1)
	        	console.log("OK");
	          //Pregunta enviada correctamente
	      	},
			'error': function (error) {
				console.log(error)
			}
	    })
	}

</script>
@stop