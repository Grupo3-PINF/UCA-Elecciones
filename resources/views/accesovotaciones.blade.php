<?php $titulo = "Acceso votaciones"; ?>
@extends('layouts/layout')
@section('content')
<div id="accesovotaciones">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>SELECCIONE UNA VOTACIÓN</h3>
				<p>Para realizar su votación, haga click en uno de los enlaces disponibles. A continuación usted será redirigido al voto.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
			@if(count($pnr) < 1)
                <h4>En estos momentos no hay votaciones activas</h4>
            @else
            	<table class="table">
					<thead>
						<tr>
                    	@foreach($pnr as $votacion)
                        	<th>Título</th>
                        	<th>Tipo</th>
                        	<th></th>
                    	@endforeach
                    	</tr>
                    </thead>
                    <tbody>
                    	<tr>
                    	@foreach($pnr as $votacion)
                    		<td><b>{{$votacion->titulo}}</b></td>
                    		<td>{{$votacion->esCompleja == 0 ? 'Pregunta simple' : 'Pregunta compleja'}}</td>
                    		<td><a href="{{ url('/opciones/'.$votacion->id)}}">Votar</a></td>
                    	@endforeach
                    	</tr>
                    </tbody>
                </table>
            @endif
        	</div>
		</div>
	</div>
</div>

@stop