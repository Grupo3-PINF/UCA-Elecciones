<?php $titulo = "consultas"; ?>
@extends('layouts/layout')
@section('content')
<div id="consultas">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>Consultas</h3>
                    @if(count($consultas) < 1)
                        <p>En estos momentos no hay consultas activas</p>
                    @else
                    	<table class="table">
  							<thead>
  								<tr>
                            	@foreach($pnr as $preguntas)
                                	<th>{{$preguntas->titulo}}</th>
                            	@endforeach
                            	</tr>
                            </thead>
                            <tbody>
                            	<tr>
                            	@foreach($pnr as $preguntas)
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