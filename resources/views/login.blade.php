<?php $titulo = "Login"; ?>
@extends('layouts/layout')
@section('content')
<div id="login">
	<form action="{{ url('/login') }}" method="POST">
		<div class="container">
			<div class="row">
				<div class="col-10 col-sm-8 offset-sm-2 offset-1">
					@csrf
			        <h2 class="form-title">Acceso privado</h2>
		            <div class="form-info"><p>Indique su identificador y clave única de acceso a servicios (Campus virtual, servicios de personal, CAU...).</p></div>
					<div class="form-group container">
						<div class="row">
							<label class="col-12 col-sm-5" for="username">Nombre de usuario</label>
							<input class="col-12 col-sm-7" type="text" placeholder="Nombre de usuario" name="username" value="">
						</div>
					</div>
					<div class="form-group container">
						<div class="row">
							<label class="col-12 col-sm-5" for="password">Clave de acceso</label>
							<input class="col-12 col-sm-7" type="password" id="password" placeholder="Clave de acceso" name="password">
						</div>
					</div>
					@if(Session::has('mensaje'))
					<div class="form-group container">
						<div class="row">
							<div class="col-12 alert alert-danger">
								<p>{{Session::get('mensaje')}}</p>
							</div>
						</div>
					</div>
					@endif
					<div class="form-group container">
						<div class="row">
							<div class="col-12 text-right">
								<button type="submit" class="btn btn-primary" aria-label="Acceder">Acceder</button>
								<a href="{{url('/login')}}" class="btn btn-cancel" role="button" aria-label="Cancelar">Cancelar</a>
							</div>
						</div>
					</div>
					<div class="form-group container">
						<div class="row text-center">
							<div class="col-12">
								<a href="#" class="btn btn-xtra-info"><em>¿Problemas con la clave de acceso?</em></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@stop
