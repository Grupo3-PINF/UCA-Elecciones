<?php $titulo = "borrarvotacion"; ?>
@extends('layouts/layout')
@section('content')
<div id="crearvotacion">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="col-12">
					<div class="alert alert-success d-none" id="msg_div">
						<span id="res_message"></span>
				</div>
				<h3 id = "tit-p">PREGUNTAS ABIERTAS</h3>
                    @if(count($preguntas) < 1)
                        <p>En estos momentos no hay preguntas abiertas</p>
					@else
                    	<table class="table" id="tabla-p">
  							<thead>
  								<tr>
                            	@foreach($preguntas as $p)
									<th>{{$p->titulo}}
									</th>
								@endforeach
								</tr>
                            </thead>
                            <tbody>
                            	<tr>
								@foreach($preguntas as $p)
								<td>
									<button type="button" class="btn btn-primary" id="{{('pregunta'.$p->id)}}">Eliminar</button>
									<script type="text/javascript">
										$(document).ready(function(){
											$("#{{('pregunta'.$p->id)}}").click(function(){
												var data = "{{$p->id}}"
												$.ajax({
													url:'{{route('borrarvotacion.borrar')}}',
													data:{"pregunta":data,"_token": "{{ csrf_token() }}","tipo":"pregunta"},
													type: 'POST',
													success: function(response) {
														if(response.value)
														{
															$("#{{('pregunta'.$p->id)}}").hide();
															$('#res_message').show();
															$('#res_message').html(response.message);
															$('#msg_div').removeClass('alert-danger');
															$('#msg_div').addClass('alert-success');
															$('#msg_div').removeClass('d-none');
															setTimeout(function() {
																window.location.reload();
															}, 2000);	
														}
														else
														{
															$('#res_message').show();
															$('#res_message').html(response.message);
															$('#msg_div').addClass('alert-danger');
															$('#msg_div').removeClass('alert-success');
															$('#msg_div').removeClass('d-none');
														}		
													}
												});
											})
										})
									</script>
                            	@endforeach
                            	</tr>
                            </tbody>
                        </table>
					@endif
				<h3 id="tit-e">ELECCIONES ABIERTAS</h3>
				@if(count($elecciones) < 1)
					<p>En estos momentos no hay elecciones abiertas</p>
				@else
					<table class="table" id="table-e">
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
													$("#{{('eleccion'.$e->id)}}").prop('disabled', true);
													$('#res_message').show();
													$('#res_message').html(response.mensaje);
													$('#msg_div').removeClass('alert-danger');
													$('#msg_div').addClass('alert-success');
													$('#msg_div').removeClass('d-none');
													setTimeout(function() {
														window.location.reload();
													}, 3000);			
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
					<td>
				@endif
			</div>
		</div>
	</div>
</div>

@stop