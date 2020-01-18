<?php $titulo = "Modificar votacion"; ?>

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
                    <h4> ELECCIONES ABIERTAS </h3>
                        @if(count($elecciones)>0)
                            <ul id="list-questions">
                                @foreach ($elecciones as $e)
                                    <a id="{{('eleccion'.$e->id)}}" onclick="seleccionaEleccion({{('eleccion'.$e->id)}});" href="#">
                                    <li >{{$e->titulo}}</li>
                                    </a>
                                @endforeach
                            </ul>
                        @else
                            <a>Sin elecciones</a>
                        @endif
                 </div>
			</div>
            @include('modificarvotacion/modificareleccion')
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
	function seleccionaEleccion(valor) {
		$.ajax({
			type: 'POST',
			url: "{{route('modvotacion.mostrarCampos')}}",
			data: {
				"_token": "{{ csrf_token() }}",
				"id": valor.id,
				"tipo":"eleccion",
			},
			success: function(response) {
				onload = recibirGruposEleccion();
				onload = recibirCandidatos();
				let ch = document.getElementById("tiempo-real-eleccion");
				ch.checked = false;
				ch.parentElement.hidden = true;
				$(".step-1").hide();
				$("#steps-eleccion").toggleClass("hide").delay(1200);
				$("#steps-eleccion").addClass("flex").delay(1200)
			},
			error: function(error) {
				console.error(error)
			}
		})
	}
</script>
@stop