<?php $titulo = "elecciones"; ?>
@extends('layouts/layout')
@section('content')
<div id="elecciones">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>ELECCIONES</h3>
                    @if(count($elecciones) < 1)
                        <p>En estos momentos no hay elecciones activas</p>
                    @else
                    	<table class="table">
  							<thead>
  								<tr>
                            	@foreach($elecciones as $preguntas)
                                	<th>{{$preguntas->titulo}}</th>
                            	@endforeach
                            	</tr>
                            </thead>
                            <tbody>
                            	<tr>
                            	@foreach($elecciones as $preguntas)
                            		<td><a href="{{ url('/opciones/'.$preguntas->id)}}">Votar</a></td>
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