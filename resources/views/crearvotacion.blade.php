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
					<div class="votacion">
						<h4>Preguntas</h4>
						<i class="far fa-question-circle"></i>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="votacion">
						<h4>Encuesta</h4>
						<i class="far fa-envelope"></i>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
				</div>
				<div class="col-12 col-sm-4">
					<div class="votacion">
						<h4>Desarrollo</h4>
						<i class="far fa-file-code"></i>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
					</div>
				</div>
			</div>
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
		</div>
	</div>
</div>
<script>
	$(".step-one .votacion").click(function(){
  		$(".step-one").hide(1200);
  		$(".step-two").addClass("flex").delay(1200).queue(function(){
    		$(this).removeClass("hide").dequeue();
		});
	});
	$(".step-two .votacion").click(function(){
  		$(".step-two").hide(1200);
  		$(".step-three").addClass("flex").delay(1200).queue(function(){
    		$(this).removeClass("hide").dequeue();
		});
	});
	$(".step-three .votacion").click(function(){
  		$(".step-three").hide(1200);
  		$(".step-four").addClass("flex").delay(1200).queue(function(){
    		$(this).removeClass("hide").dequeue();
		});
	});
</script>
@stop