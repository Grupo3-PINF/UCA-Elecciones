<?php $titulo = "Crear votacion"; ?>
@extends('layouts/layout')
@section('content')
<div id="crearvotacion">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>CREADOR DE PREGUNTAS Y ENCUESTAS</h3>
				<p>VotUCA es una herramienta intuitiva desarrollada con el fin de facilitar la creación de procesos electorales, digitalizando las votaciones y eliminando la necesidad de un escrutinio manual. El futuro es ahora.</p>
			</div>
		</div>
		<form action="{{url('/crearvotacion')}}" method='POST'>
		@csrf

		@if(!@isset($mensaje))
		<div class="helper">
			<div class="step-1 row">
				<div class="col-12 col-md-4">
					<div id="votacion-pregunta" class="votacion">
						<h4>Preguntas</h4>
						<i class="far fa-question-circle"></i>
						<p>Crea una votación simple en la que los votantes pueden expresar su acuerdo o desacuerdo respecto a un tema.</p>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div id="votacion-encuesta" class="votacion">
						<h4>Encuesta</h4>
						<i class="far fa-envelope"></i>
						<p>Crea una encuesta para obtener un sondeo sobre la opinión de un grupo de personas respecto a un tema.</p>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div id="votacion-desarrollo" class="votacion">
						<h4>Elecciones</h4>
						<i class="fas fa-graduation-cap"></i>
						<p>Crea una votación en la que los votantes eligen a un candidato de entre los que se hayan presentado.</p>
					</div>
				</div>
			</div>
			<div id="steps-pregunta">
				<div class="step-2 row hide">
					<div class="col-12">
						<h4>¿Quieres que sea vinculante?</h4>
						<p>El resultado de la votación será secreto hasta que esta misma haya finalizado. Si es vinculante, el resultado será secreto hasta el final, si no lo es, el resultado podrá consultarse en el mismo momento en el que alguien realiza la votación. Pensada para preguntas importantes.</p>
					</div>
					<div class="col-12 col-md-4 offset-md-1 votacion" onclick="guardarResultado(2,'si')">
						<h5>Sí</h5>
						<i class="far fa-check-circle"></i>
						<p>Recomendada para preguntas importantes.</p>
					</div>
					<div class="col-12 col-md-4 offset-md-2 votacion" onclick="guardarResultado(2,'no')">
						<h5>No</h5>
						<i class="far fa-times-circle"></i>
						<p>Recomendada para realizar un sondeo.</p>
					</div>
				</div>
				<div class="step-3 row hide">
					<div class="col-12">
						<h4>¿Quieres que sea compleja?</h4>
						<p>Con esta opción puedes dotar de distintas opciones para la pregunta. Si la pregunta es simple, las respuestas serán: sí, no, abstenerse.</p>
					</div>
					<div class="col-12 col-md-4 offset-md-1 votacion" onclick="guardarResultado(3,'si')">
						<h5>Sí</h5>
						<i class="far fa-check-circle"></i>
						<p>Recomendada para agregar más opciones.</p>
					</div>
					<div class="col-12 col-md-4 offset-md-2 votacion" onclick="guardarResultado(3,'no')">
						<h5>No</h5>
						<i class="far fa-times-circle"></i>
						<p>Recomendada para que la pregunta sea simple.</p>
					</div>
				</div>
				<div class="step-4 row hide">
					<div class="col-12">
						<h4>¿Quieres que sea restringida?</h4>
						<p>Con esta opción, la pregunta sólo estará disponible para un determinado grupo de usuarios (a su elección).</p>
					</div>
					<div class="col-12 col-md-4 offset-md-1 votacion" onclick="guardarResultado(4,'si')">
						<h5>Sí</h5>
						<i class="far fa-check-circle"></i>
						<p>Recomendada para un determinado grupo de usuarios.</p>
					</div>
					<div class="col-12 col-md-4 offset-md-2 votacion" onclick="guardarResultado(4,'no')">
						<h5>No</h5>
						<i class="far fa-times-circle"></i>
						<p>Recomendada para el acceso de cualquier usuario.</p>
					</div>
				</div>
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
						<button class="btn btn-primary" name="crear" value="eleccion" type="submit">Enviar</a>
					</div>
				</div>
			</div>
			</form>
		</div>
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
	//Para la pregunta, hay distintas opciones
	$(".step-1 #votacion-pregunta").click(function(){
  		$(".step-1").hide(1200);
  		$("#steps-pregunta .step-2").addClass("flex").delay(1200).queue(function(){
    		$(this).removeClass("hide").dequeue();
		});
		$("#eleccion-1").val("pregunta");
	});

	function guardarResultado(paso, resultado) {
		var next = parseInt(paso)+1;
		$("#eleccion-"+paso).val(resultado);
		$("#steps-pregunta .step-" + paso + " .votacion").click(function(event){
			event.preventDefault();
	  		$("#steps-pregunta .step-" + paso).hide(600);
	  		$("#steps-pregunta .step-" + next).addClass("flex").delay(600).queue(function(){
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