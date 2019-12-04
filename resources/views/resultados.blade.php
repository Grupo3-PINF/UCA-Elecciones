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
                <form method="POST">
                    @csrf
                    <label>Elija una votación</label>
                    <select class="form-control" id="opcionpregunta" name="opcionpregunta">
                        <option value="1">¿Cuántos años crees que tiene el vicerrector?</option>
                        <option value="2">¿Crees que Carlos Rioja va a aprobarnos?</option>
                        <option value="9">¿Te gusta más el café o el bizcochito?</option>
                    </select>
                <div id ="btn-primary"><a class="btn btn-primary">Enviar</a></div>
                </form>
            </div>
            @isset($votos)
            <div class="col-12 col-md-6 offset-md-1">
                <h4 class="text-center">¿Te gusta más el café o el bizcochito?</h4>
                <canvas id="doughnutChart" width="30" height="20"></canvas>
            </div>
            @endisset
        </div>
    </div>
</div>

<script>
/*
    new Chart(document.getElementById("doughnut-chart"), {
    type: 'doughnut',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: $votos["votos"]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});*/
$("#btn-primary").click(function(){
    //aquí comprobar si el usuario le ha vuelto a dar click al boton de nuevo para otra pregunto(o la misma) o le da cancelar vista
    //¡¡¡RECORDATORIO!!!Neceistamos un parametro enviado desde el controlador para saber cuando mostrar la grafica en tiempo real o no
        //if(d.getTime() - tiempo_tomado > 4) //ó >= 5
        
            $.ajax({
                url: "{{ route('resultado.post')}}", //web.php poner nombre a la ruta de post de resultados ->name('resultado.post)
                type: 'post',
                data: {'_token':"{{csrf_token()}}", 'id': "9"}, // en id tiene que ir el id de la pregunta de la que hay que sacar los resultados.
                success: function(vector)
                {
                    //$('#loko').text(vector['votos']);  //esta linea os asegura que el resultado llega correctamente.
                    if(vector['OK'] == 1) //aqui entra seguro da un error en la linea de de data porque dice que no está.
                    {
                    //doughnut
                        var ctxD = $('#doughnutChart').get(0);
                        var myLineChart = new Chart(ctxD,{
                            type: 'doughnut',
                            data: {
                                labels: data[vector['opciones']],
                                datasets: [
                                    {
                                        data: data["votos"],
                                        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                                    }
                                ]
                            },
                            options: {
                                responsive: false
                            }
                        });
                    }
                },
                error: function()
                {
                    console.log("Error");
                }
            })
        
    
})
</script>
@stop
