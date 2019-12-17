<?php $titulo = "preguntasrestringidas"; ?>
@extends('layouts/layout')
@section('content')
<div id="preguntasnorestringidas">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<p>
					Esto son las Preguntas No Restringidas.
				</p>
				<div class="col-12">
                    @if(count($pnr) < 1)
                        <div>No hay Preguntas</div>
                    @else
                            @foreach($pnr as $preguntas)
                            <p>
                                <td>{{$preguntas->titulo}}</td>
                                <a href="{{ url('/opciones/'.$preguntas->id)}}">Votar</a>
                            </p>
                            @endforeach
                    @endif
				</div>	
			</div>
		</div>
	</div>
</div>

@stop