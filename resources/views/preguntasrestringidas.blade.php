<?php $titulo = "preguntasrestringidas"; ?>
@extends('layouts/layout')
@section('content')
<div id="preguntasrestringidas">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<p>
					Esto son las Preguntas Restringidas.
				</p>
				<div class="col-12">
                    @if(count($pr) < 1)
                        <div>No hay Preguntas</div>
                    @else
                            @foreach($pr as $preguntas)
                            <p>
                                <td>{{$preguntas->titulo}}</td>
                                <a href="{{ url('/opciones/'.$preguntas->id) }}">Votar</a>                                                    
                            </p>
                            @endforeach
                    @endif
				</div>	
			</div>
		</div>
	</div>
</div>

@stop




