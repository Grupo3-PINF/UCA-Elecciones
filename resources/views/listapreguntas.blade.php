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
                    <h4> PREGUNTAS ABIERTAS </h3>
                        @if(count($preguntas)>0)
                            <ul id="list-questions">
                                @foreach ($preguntas as $p)
                                    <a id="{{('pregunta'.$p->id)}}" onclick="seleccionaPregunta({{('pregunta'.$p->id)}});" href="#">
                                    <li >{{$p->titulo}}</li>
                                    </a>
                                @endforeach
                            </ul>
                        @else
                            <a>Sin preguntas</a>
                        @endif
                 </div>
			</div>
            @include('modificarvotacion/modificarpregunta')
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
	function seleccionaPregunta(valor, deConsulta) {
		$.ajax({
			type: 'POST',
			url: "{{route('modvotacion.mostrarCampos')}}",
			data: {
				"_token": "{{ csrf_token() }}",
				"id": valor.id
			},
			success: function(response) {
				onload = recibirGruposPregunta();
				$("#steps-eleccion").remove();
				$("#steps-consulta").remove();
				if (!deConsulta) {
					let ch = document.getElementById("tiempo-real-pregunta");
					ch.checked = false;
					ch.parentElement.hidden = true;
				}				
				$(".step-1").hide();
				$("#steps-pregunta").toggleClass("hide").delay(1200);
				$("#steps-pregunta").addClass("flex").delay(1200)
			},
			error: function(error) {
				console.error(error)
			}
		})
	}
</script>
@stop