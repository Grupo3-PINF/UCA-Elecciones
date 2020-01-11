<?php $titulo = "Home"; ?>
@extends('layouts/layout')
@section('content')
<div id="home">
	<div id="carousel" class="carousel slide" data-ride="carousel">
		<!--
		<ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
			<li data-target="#carousel" data-slide-to="1"></li>
			<li data-target="#carousel" data-slide-to="2"></li>
		</ol>
		-->
		<div class="carousel-inner">
			<div class="carousel-item active">
			  <img class="d-block w-100" src="{{asset('/images/slide1.jpg')}}" alt="Primer elemento">
			</div>
			<!--
			<div class="carousel-item">
			  <img class="d-block w-100" src="{{asset('/images/slide2.jpg')}}" alt="Segundo elemento">
			</div>
			<div class="carousel-item">
			  <img class="d-block w-100" src="{{asset('/images/slide3.jpg')}}" alt="Tercer elemento">
			</div>
			-->
		</div>
		<!--
		<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		-->
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 col-novedades">
				<h3>Novedades</h3>
				<p>Este proyecto aún está en desarrollo, pero pronto podrá disfrutar de esta tecnología para procesos electorales.</p>
			</div>
			<div class="col-12 col-md-4 col-novedades">
				<h4>Creador de preguntas</h4>
				<img src="{{asset('/images/home1.png')}}" class="d-block w-100" alt="Home-1">
				<p>Hasta ahora hemos desarrollado un generador de preguntas, encuestas y elecciones. Está en su primera versión, pero pronto esperamos acabarlo.</p>
			</div>
			<div class="col-12 col-md-4 col-novedades">
				<h4>Sistema de login</h4>
				<img src="{{asset('/images/home2.png')}}" class="d-block w-100" alt="Home-2">
				<p>Nuestro sistema de login es completamente seguro y dota al sistema de un cifrado de contraseñas para la máxima seguridad.</p>
			</div>
			<div class="col-12 col-md-4 col-novedades">
				<h4>Acceso a votaciones</h4>
				<img src="{{asset('/images/home3.png')}}" class="d-block w-100" alt="Home-3">
				<p>Para poder conocer los resultados de las distintas votaciones, hemos desarrollado un módulo de acceso y elección de las mismas.</p>
			</div>
			<div class="col-12 col-md-4 col-novedades">
				<h4>Resultados</h4>
				<img src="{{asset('/images/home4.png')}}" class="d-block w-100" alt="Home-4">
				<p>Se ha desarrollado un módulo que permite visualizar gráficamente el número de votos de una votación.</p>
			</div>
		</div>
	</div>
</div>
@stop
