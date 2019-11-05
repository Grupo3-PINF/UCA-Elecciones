<?php $titulo = "Login"; ?>
@extends('layouts/layout')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<form action="{{ url('/login') }}" method="POST">
				<div class="form-group">
					<input placeholder="Username" type="text" name="username">
					<input placeholder="Password" type="password" name="password">
					<button type="submit" class="btn btn-primary">Enviar</button>
				</div>
			</form>
		</div>
	</div>
</div>

@stop
