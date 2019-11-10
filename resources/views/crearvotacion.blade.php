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
		<div class="step-one row">
			<div class="col-xs-12 col-4">
				<div class="votacion">
					<h4>Preguntas</h4>
					<i class="far fa-question-circle"></i>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
				</div>
			</div>
			<div class="col-xs-12 col-4">
				<div class="votacion">
					<h4>Encuesta</h4>
					<i class="far fa-envelope"></i>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
				</div>
			</div>
			<div class="col-xs-12 col-4">
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
			<div class="col-xs-12 col-4 offset-1 votacion">
				<h5>Sí</h5>
				<i class="far fa-check-circle"></i>
			</div>
			<div class="col-xs-12 col-4 offset-2 votacion">
				<h5>No</h5>
				<i class="far fa-times-circle"></i>
			</div>
		</div>
		<div class="step-three row hide">
			<div class="col-12">
				<h4>¿Quieres que sea compleja?</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
			</div>
			<div class="col-xs-12 col-4 offset-1 votacion">
				<h5>Sí</h5>
				<i class="far fa-check-circle"></i>
			</div>
			<div class="col-xs-12 col-4 offset-2 votacion">
				<h5>No</h5>
				<i class="far fa-times-circle"></i>
			</div>
		</div>
		<div class="step-four row hide">
			<div class="col-12">
				<h4>¿Quieres que sea restringida?</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae congue sem, eu dignissim urna.</p>
			</div>
			<div class="col-xs-12 col-4 offset-1 votacion">
				<h5>Sí</h5>
				<i class="far fa-check-circle"></i>
			</div>
			<div class="col-xs-12 col-4 offset-2 votacion">
				<h5>No</h5>
				<i class="far fa-times-circle"></i>
			</div>
		</div>
	</div>
</div>
<script>
	$(".step-one .votacion").click(function(){
  		$(".step-one").toggleClass("hide");
  		$(".step-two").toggleClass("hide");
	});
	$(".step-two .votacion").click(function(){
  		$(".step-two").toggleClass("hide");
  		$(".step-three").toggleClass("hide");
	});
	$(".step-three .votacion").click(function(){
  		$(".step-three").toggleClass("hide");
  		$(".step-four").toggleClass("hide");
	});
</script>
@stop