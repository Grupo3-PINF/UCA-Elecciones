<?php $titulo = "Opciones_eleccion"; ?>
@extends('layouts/layout')
@section('content')
<div id="opciones_eleccion">
	<div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <form method="POST" action="{{url('/opciones_eleccion')}}">
                    @csrf
                    <h3>{{$pregunta}}</h3>
                    <select class="form-control" id="respuesta" name="respuesta">
                    @foreach($candidatos as $c)
                        <option value="{{$loop->index}}.{{$id}}">{{$c}}</option>
                    @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Votar</button>
                </form>
            </div>
        </div>
	</div>
</div>

@stop