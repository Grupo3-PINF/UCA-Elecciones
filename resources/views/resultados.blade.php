<?php $titulo = "Resultados"; ?>
@extends('layouts/layout')
@section('content')
<div id="resultados">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>RESULTADOS DE LAS ELECCIONES</h3>
				<p>Seleccione su pregunta a través de nuestro corrector para ver los resultados correspondientes.</p>
                <p>La gráfica sólo aparecerá una vez que haya seleccionado la pregunta.</p>
			</div>
		</div>
        <div class="row">
            <div class="col-12 col-md-5">
                <form method="POST" action="{{url('/resultados')}}">
                    @csrf
                    <label>Elija una votación</label>
                    <select class="form-control" id="opcionpregunta" name="opcionpregunta">
                        <option value="1">¿Cuántos años crees que tiene el vicerrector?</option>
                        <option value="2">¿Crees que Carlos Rioja va a aprobarnos?</option>
                        <option value="9">¿Te gusta más el café o el bizcochito?</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </form>
            </div>
            @isset($array_votacion)
            <div class="col-12 col-md-6 offset-md-1">
                <h4 class="text-center">¿Te gusta más el café o el bizcochito?</h4>
                <canvas id="barChart" width="30" height="20"></canvas>
            </div>
            @endisset
        </div>
	</div>
</div>

<script>
    var ctxB = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(ctxB, {
        type: 'bar',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
         }
    }
    });
</script>
@stop

