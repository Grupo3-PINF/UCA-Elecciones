<?php $titulo = "borrarvotacion"; ?>
@extends('layouts/layout')
@section('content')
<div id="borrarvotacion">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>PREGUNTAS ABIERTAS</h3>
                    @if(count($preguntas) < 1)
                        <p>En estos momentos no hay preguntas abiertas</p>
                    @else
                    	<table class="table">
  							<thead>
  								<tr>
                            	@foreach($preguntas as $p)
                                	<th>{{$p->titulo}}</th>
                            	@endforeach
                            	</tr>
                            </thead>
                            <tbody>
                            	<tr>
                            	@foreach($preguntas as $p)
									<td><button type="button" class="btn btn-primary" id="{{('pregunta'.$p->id)}}">Eliminar</button>
									<script type="text/javascript">
										$(document).ready(function(){
											console.log("bro")
											$("#{{('pregunta'.$p->id)}}").click(function(){
												var data = "{{$p->id}}"
												$.ajax({
													url:'{{route('borrarvotacion.borrar')}}',
													data:{"pregunta":data,"_token": "{{ csrf_token() }}","tipo":"pregunta"},
													type: 'POST',
													success: function(response) {
														alert(response);
														location.reload();
													}
												});
											})
										})
									</script>
									</td>
                            	@endforeach
                            	</tr>
                            </tbody>
                        </table>
					@endif
				<h3>ELECCIONES ABIERTAS</h3>
				@if(count($elecciones) < 1)
					<p>En estos momentos no hay elecciones abiertas</p>
				@else
					<table class="table">
						<thead>
							<tr>
							@foreach($elecciones as $e)
								<th>{{$e->titulo}}</th>
							@endforeach
							</tr>
						</thead>
						<tbody>
							<tr>
							@foreach($elecciones as $e)
								<td><button type="button" class="btn btn-primary" id="{{('eleccion'.$e->id)}}">Eliminar</button>
								<script type="text/javascript">
									$(document).ready(function(){
										$("#{{('eleccion'.$e->id)}}").click(function(){
											var data = "{{$e->id}}"
											$.ajax({
												url:'{{route('borrarvotacion.borrar')}}',
												data:{"eleccion":data,"_token": "{{ csrf_token() }}","tipo":"eleccion"},
												type: 'POST',
												success: function(response) {
													alert(response);
													location.reload();
												}
											});
										})
									})
								</script>
								</td>
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