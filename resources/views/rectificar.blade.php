<?php $titulo = "Rectificar"; ?>
@extends('layouts/layout')
@section('content')
<div id="rectificar">
	<div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <form method="POST" action="{{url('/rectificar')}}">
                    @csrf
                    <label>Desea rectificar su voto</label>
                    <select class="form-control" id="rectificacion" name="rectificacion">
                        <option value="1.{{$id}}-{{$idopcion}}">Sí</option>
                        <option value="2.{{$id}}-{{$idopcion}}">No</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </form>
            </div>
        </div>
	</div>
</div>

@stop