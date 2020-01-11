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
											$("#{{('pregunta'.$p->id)}}").click(function(){
												console.log("lososos")
												var data = "{{$p->id}}"
												$.ajax({
													url:'/borrarvotacion',
													data:{"pregunta":data,"_token": "{{ csrf_token() }}"},
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