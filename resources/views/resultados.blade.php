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
                        <option value="3">¿Te gusta más el café o el bizcochito?</option>
                    </select>
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </form>
            </div>
            @isset($array_votacion)
            <div class="col-12 col-md-6 offset-md-1">
                <h4 class="text-center">¿Te gusta más el café o el bizcochito?</h4>
                <canvas id="doughnutChart" width="30" height="20"></canvas>
            </div>
            @endisset
        </div>
	</div>
</div>

<script>
    //doughnut
    var ctxD = $('#doughnutChart').get(0);
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Red", "Green", "Yellow", "Grey", "Dark Grey"],
            datasets: [{
                data: [300, 50, 100, 40, 120],
                backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
@stop

