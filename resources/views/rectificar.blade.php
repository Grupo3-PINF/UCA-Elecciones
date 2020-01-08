<?php $titulo = "Rectificar"; ?>
@extends('layouts/layout')
@section('content')
<div id="rectificar">
	<div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <form method="POST" action="{{url('/rectificar')}}">
                    @csrf
                    <h3>{{$pregunta}}</h3>
                    <select class="form-control" id="respuesta" name="respuesta">
                    @foreach($ops as $p)
                        <option value="{{$loop->index}}.{{$id}}">{{$p}}</option>
                    @endforeach
                    </select>
                    <button class="btn btn-primary" type="submit">Votar</button>
                </form>
            </div>
        </div>
	</div>
</div>

@stop