<?php $titulo = "Acceso votaciones"; ?>
@extends('layouts/layout')
@section('content')
<div id="accesovotaciones">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<p>

				</p>
			</div>
		</div>
		<div class="helper">
			<div class="step-1 row">
				<div class="col-12 col-sm-4">
					@foreach(array('Preguntas no Restringidas','Preguntas Restringidas','Consultas','Elecciones') as $opciones)
						<h4>{{$opciones}}</h4>
						@if($opciones == 'Preguntas no Restringidas')
	                        <a href="{{url('/preguntasnorestringidas/')}}">Mostrar</a>
	                    @endif
						@if($opciones == 'Preguntas Restringidas')
	                        <a href="{{url('/preguntasrestringidas/')}}">Mostrar</a>
	                    @endif
						@if($opciones == 'Consultas')
	                        <a href="{{url('/preguntasrestringidas/')}}">Mostrar</a>
	                    @endif
						@if($opciones == 'Elecciones')
	                        <a href="{{url('/preguntasrestringidas/')}}">Mostrar</a>
	                    @endif	                    	                    	                    
						<i class="far fa-envelope"></i>
					@endforeach	
				</div>
			</div>
		</div>
	</div>
</div>

@stop