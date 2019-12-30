<?php $titulo = "Opciones"; ?>
@extends('layouts/layout')
@section('content')
<div id="opciones">
	<div class="container">
        <div class="row">
            <!-- MENSAJE DE VOTACION FALLIDA PORQUE YA HA VOTADO -->
            @isset($votado)
                <div class="col-12">
                    <div class="alert alert-danger">
                        <p>No puede realizarse el voto porque usted ya ha votado con anterioridad.</p>
                    </div>
                </div>
            @else
                <div class="col-12 col-md-5">
                    <form method="POST" action="{{url('/opciones')}}">
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
                <!-- AQUI SE VA A MOSTRAR EL AVISO DE VOTACION CORRECTA -->
                @isset($exito)
                    <div class="col-12">
                        <div class="alert alert-success">
                            <p>Su votación ha sido registrada correctamente</p>
                        </div>
                    </div>
                @endif
            @endif
        </div>
	</div>
</div>

@stop