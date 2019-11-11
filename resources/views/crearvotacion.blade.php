<?php $titulo = "Crear votacion"; ?>
@extends('layouts/layout')
@section('content')
<div id="crearvotacion">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>LOREM IPSUM</h3>
				<p>Parrafo to grande y guapo de prueba pa ver xdxd Parrafo to grande y guapo de prueba pa ver xdxd Parrafo to grande y guapo de prueba pa ver xdxd Parrafo to grande y guapo de prueba pa ver xdxd Parrafo to grande y guapo de prueba pa ver xdxd Parrafo to grande y guapo de prueba pa ver xdxd Parrafo to grande y guapo de prueba pa ver xdxd</p>
			</div>
		</div>
		<div id="crearvotacion-helper">
			<div class="step-one row">
				<div class="col-12 col-sm-4">
					<div id="votacion-pregunta" class="votacion">
						<h4>Preguntas</h4>
						<i class="far fa-question-circle"></i>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div id="votacion-encuesta" class="votacion">
						<h4>Encuesta</h4>
						<i class="far fa-envelope"></i>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div id="votacion-desarrollo" class="votacion">
						<h4>Desarrollo</h4>
						<i class="far fa-file-code"></i>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
				</div>
			</div>
			<div id="steps-pregunta">
				<div class="step-two row hide">
					<div class="col-12">
						<h4>¿Quieres que sea vinculante?</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
					<div class="col-12 col-sm-4 offset-sm-1 votacion">
						<h5>Sí</h5>
						<i class="far fa-check-circle"></i>
					</div>
					<div class="col-12 col-sm-4 offset-sm-2 votacion">
						<h5>No</h5>
						<i class="far fa-times-circle"></i>
					</div>
				</div>
				<div class="step-three row hide">
					<div class="col-12">
						<h4>¿Quieres que sea compleja?</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
					<div class="col-12 col-sm-4 offset-sm-1 votacion">
						<h5>Sí</h5>
						<i class="far fa-check-circle"></i>
					</div>
					<div class="col-12 col-sm-4 offset-sm-2 votacion">
						<h5>No</h5>
						<i class="far fa-times-circle"></i>
					</div>
				</div>
				<div class="step-four row hide">
					<div class="col-12">
						<h4>¿Quieres que sea restringida?</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
					<div class="col-12 col-sm-4 offset-sm-1 votacion">
						<h5>Sí</h5>
						<i class="far fa-check-circle"></i>
					</div>
					<div class="col-12 col-sm-4 offset-sm-2 votacion">
						<h5>No</h5>
						<i class="far fa-times-circle"></i>
					</div>
				</div>
				<div id="pregunta-basica-div" class="step-five row hide">
					<div class="col-12">
						<h4>¿Cuál es la pregunta?</h4>
					</div>
					<div class="col-12">
						<label>Introduzca su pregunta</label>
					</div>
					<div class="col-12">
						<textarea type="text" name="pregunta-basica" placeholder="Introduzca su pregunta"></textarea>
					</div>
					<div class="col-12">
						<a class="btn btn-primary" href="#">Enviar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(".step-one #votacion-pregunta").click(function(){
  		$(".step-one").hide(1200);
  		$("#steps-pregunta .step-two").addClass("flex").delay(1200).queue(function(){
    		$(this).removeClass("hide").dequeue();
		});
	});
	$("#steps-pregunta .step-two .votacion").click(function(){
  		$("#steps-pregunta .step-two").hide(1200);
  		$("#steps-pregunta .step-three").addClass("flex").delay(1200).queue(function(){
    		$(this).removeClass("hide").dequeue();
		});
	});
	$("#steps-pregunta .step-three .votacion").click(function(){
  		$("#steps-pregunta .step-three").hide(1200);
  		$("#steps-pregunta .step-four").addClass("flex").delay(1200).queue(function(){
    		$(this).removeClass("hide").dequeue();
		});
	});
	$("#steps-pregunta .step-four .votacion").click(function(){
  		$("#steps-pregunta .step-four").hide(1200);
  		$("#steps-pregunta .step-five").addClass("flex").delay(1200).queue(function(){
    		$(this).removeClass("hide").dequeue();
		});
	});
</script>
@stop