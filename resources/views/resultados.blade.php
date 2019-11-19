<?php $titulo = "Resultados"; ?>
@extends('layouts/layout')
@section('content')
<div id="resultados">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>RESULTADOS DE LAS ELECCIONES</h3>
				<p>Gráfica circular con el escruitinio actual de las votaciones:</p>
			</div>
		</div>
        <!--
        <div class="row">
			<div class="col-12 col-md-6 offset-md-3">
                <canvas id="doughnutChart" width="30" height="20"></canvas>
			</div>
		</div>
        -->
        <div class="row">
            <div class="col-6">
                <form method="POST" action="{{url('/resultados/mostrarResultado')}}">
                    <label>Elija una votación</label>
                    <select class="form-control" id="opcionpregunta" name="opcionpregunta">
                        <option>¿Cuántos años crees que tiene el vicerrector?</option>
                        <option>¿Crees que Carlos Rioja va a aprobarnos?</option>
                        <option>¿Te gusta más el café o el bizcochito?</option>
                    </select>
                    <input type="hidden" name="id-usuario">
                    <button class="btn btn-primary" type="submit">Enviar</button>
                </form>
            </div>
        </div>
	</div>
</div>

<!--<script>
    //doughnut
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
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
-->
@stop

