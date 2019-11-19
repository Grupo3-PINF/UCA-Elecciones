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
        <div class="row">
			<div class="col-7">
           
                <canvas id="doughnutChart" width="30" height="20"></canvas>
                
			</div>
		</div>
	</div>
</div>

<script>
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

@stop

