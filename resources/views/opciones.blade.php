<?php $titulo = "Opciones"; ?>
@extends('layouts/layout')
@section('content')
<div id="opciones">
	<div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <form method="POST" action="{{url('/opciones')}}">
                    @isset($ops)
                        @csrf
                        <p>Aquí debería ir una descripción breve y concisa de la votación que se está realizando</p>
                        <select class="form-control" id="respuesta" name="respuesta">
                        @foreach($ops as $p)
                            <p>
                                <option value="{{$loop->index}}.{{$id}}">{{$p}}</option>
                            </p>
                        @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit">Votar</button>
                    @endisset
                </form>
            </div>
        </div>
	</div>
</div>

@stop