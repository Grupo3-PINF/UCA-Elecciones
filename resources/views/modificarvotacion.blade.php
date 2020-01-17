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
		<div class="helper">
			<div class="step-1 row">
				<div class="col-12 col-md-4">
                    <a href="{{url('/modificarvotacion/preguntas')}}">
					<div id="modificar-pregunta" class="votacion" >
						<h4>Preguntas</h4>
						<i class="far fa-question-circle"></i>
						<p>Crea una votación de carácter genérico en la que los votantes deciden sobre un asunto de cualquier índole.</p>
                    </div>
                </a>
                </div>
				<div class="col-12 col-md-4">
                </div>
                <div class="col-12 col-md-4">
                    <a href="{{url('/modificarvotacion/elecciones')}}">
					<div id="modificar-eleccion" class="votacion" href="/modificarvotacion/preguntas">
						<h4>Elecciones</h4>
						<i class="fas fa-graduation-cap"></i>
						<p>Crea una votación en la que los participantes pueden elegir a un candidato de entre los que se han presentado.</p>
                    </div>
                    </a>
				</div>
			</div>
        </div>
	</div>
</div>
@stop