
<?php $titulo = "Acceso votaciones"; ?>
@extends('layouts/layout')
@section('content')
<div id="accesovotaciones">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(session('message')) {{session('message')}} @endif
                <h3>SELECCIONE UNA VOTACIÓN</h3>
                <p>Para realizar su votación, haga click en uno de los enlaces disponibles. A continuación usted será redirigido al voto.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            @if(count($pr) < 1)
                <h4>En estos momentos no hay votaciones activas que se puedan rectificar</h4>
            @else
                <table class="table">
                    <thead>
                        <tr>
                        @foreach($pr as $votacion1)
                            <th>Título</th>
                            <th>Tipo</th>
                            <th></th>
                            <th></th>
                        @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach($pr as $votacion1)
                            <td><b>{{$votacion1->titulo}}</b></td>
                            <td>{{$votacion1->esCompleja == 0 ? 'Pregunta simple' : 'Pregunta compleja'}}</td>
                            <td><a href="{{ url('/opciones/'.$votacion1->id)}}">Votar</a></td>
                            <td><a href="{{ url('/rectificar/'.$votacion1->id)}}">Rectificar</a></td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            @endif
            @if(count($pnr) < 1)
                <h4>En estos momentos no hay votaciones activas que no se puedan rectificar</h4>
            @else
                <table class="table">
                    <tbody>
                        <tr>
                        @foreach($pnr as $votacion2)
                            <td><b>{{$votacion2->titulo}}</b></td>
                            <td>{{$votacion2->esCompleja == 0 ? 'Pregunta simple' : 'Pregunta compleja'}}</td>
                            <td><a href="{{ url('/opciones/'.$votacion2->id)}}">Votar</a></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            @endif
            @if(count($elecciones) < 1)
                <h4>En estos momentos no hay elecciones activas</h4>
            @else
                <table class="table">
                    <tbody>
                        <tr>
                        @foreach($elecciones as $votacion3)
                            <td><b>{{$votacion3->titulo}}</b></td>
                            <td>{{'Elección'}}</td>
                            <td><a href="{{ url('/opciones_eleccion/'.$votacion3->id)}}">Votar</a></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
