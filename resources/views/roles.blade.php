<?php $titulo = "Crear votacion"; ?>
@extends('layouts/layout')
@section('content')
<div id="roles">
	<div class="container">
		<div class="row">
			<div class="col-12">
                <h3>ROLES DE LOS USUARIOS</h3>
                <form>
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-success btn-submit">Submit</button>
                        </div>
                    </div>
                </form>
			</div>
        </div>
    </div>
@isset($roles)
<h4>PINFF</h4>
@foreach ($roles as $rol)
<h5>{{$rol}}</h5>   
@endforeach
@endisset
</div>
@endsection