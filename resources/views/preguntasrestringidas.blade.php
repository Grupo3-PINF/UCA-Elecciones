<?php $titulo = "preguntasrestringidas"; ?>
@extends('layouts/layout')
@section('content')
<div id="preguntasrestringidas">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>PREGUNTAS RESTRINGIDAS</h3>
                @if(count($pr) < 1)
                    <p>No hay Preguntas</p>
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

@stop




