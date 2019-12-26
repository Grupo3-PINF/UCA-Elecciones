<?php $titulo = "Acceso votaciones"; ?>
@extends('layouts/layout')
@section('content')
<div id="accesovotaciones">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>SELECCIONE UN TIPO DE VOTACIÓN</h3>
				<p>Para consultar las votaciones disponibles, haga click en uno de los distintos tipos de votaciones existentes. A continuación usted será redirigido al voto.</p>
			</div>
		</div>
		<div class="row">
			@foreach(array('Preguntas no Restringidas','Preguntas Restringidas','Consultas','Elecciones') as $opciones)
				<div class="col-12 col-md-5 {{$loop->index % 2 == 1 ? 'offset-md-2' : ''}} pregunta">
					<h4>{{$opciones}}</h4>
					@if($opciones == 'Preguntas no Restringidas')
	                    <a href="{{url('/preguntasnorestringidas/')}}">
	                    	<div>
			                    <p>Accede a una votación de carácter genérico en la que los votantes deciden sobre un asunto de cualquier índole. Cualquiera puede votar.</p>
			                    <i class="far fa-question-circle"></i>
	                @endif
					@if($opciones == 'Preguntas Restringidas')
	                    <a href="{{url('/preguntasrestringidas/')}}">
	                    	<div>
			                    <p>Accede a una votación creada para un grupo en la que los votantes deciden sobre un asunto de cualquier índole.</p>
			                    <i class="fas fa-question-circle"></i>
	                @endif
					@if($opciones == 'Consultas')
	                    <a href="{{url('/consultas/')}}">
	                    	<div>
			                    <p>Accede a una pregunta o una elección a modo de sondeo para conocer la opinión de los votantes sobre un tema.</p>
			                    <i class="far fa-envelope"></i>
	                @endif
					@if($opciones == 'Elecciones')
	                    <a href="{{url('/elecciones/')}}">
	                    	<div>
			                    <p>Accede a una votación en la que los participantes pueden elegir a un candidato de entre los que se han presentado.</p>
			                    <i class="fas fa-graduation-cap"></i>
	                @endif
	                	</div>
	                </a>                   	                    	                    
				</div>
			@endforeach	
		</div>
	</div>
</div>

@stop