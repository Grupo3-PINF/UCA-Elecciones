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
                        @isset($preguntas)
                            @foreach ($preguntas as $pregunta)
                                <option value={{$pregunta->id}}>{{$pregunta->titulo}}</option>
                            @endforeach
                        @endisset
                        @isset($elecciones)
                            @foreach ($elecciones as $eleccion)
                                <option value="{{$eleccion->id}}e">{{$eleccion->titulo}}</option>
                            @endforeach
                        @endisset
                    </select>
                <div id ="btn-primary"><a class="btn btn-primary">Enviar</a></div>
                </form>
            </div>
            <div id="div-resultado" class="col-12 col-md-6 hide">
            <div class="overlap" class="col-12 col-md-6"></div>
                <canvas id="doughnutChart" class="w-100"></canvas>
            </div>
        </div>
    </div>
</div>
<script>



$("#btn-primary").click(function(){
    //aquí comprobar si el usuario le ha vuelto a dar click al boton de nuevo para otra pregunto(o la misma) o le da cancelar vista
    //¡¡¡RECORDATORIO!!!Neceistamos un parametro enviado desde el controlador para saber cuando mostrar la grafica en tiempo real o no
        //if(d.getTime() - tiempo_tomado > 4) //ó >= 5

            $.ajax({
                url: "{{ route('resultado.post')}}", //web.php poner nombre a la ruta de post de resultados ->name('resultado.post)
                type: 'post',
                data: {'_token':"{{csrf_token()}}", 'id': $( "#opcionpregunta option:selected" ).val()}, // en id tiene que ir el id de la pregunta de la que hay que sacar los resultados.
                success: function(vector)
                {

                    //esta linea os asegura que el resultado llega correctamente.
                    //var chrt = document.getElementById("mycanvas");
                    if($("#div-resultado").hasClass("hide")){
                        $("#div-resultado").toggleClass("hide"); //sin esta linea no va
                    }


                        var ctxD = document.getElementById("doughnutChart").getContext('2d');
                        var myLineChart = new Chart(ctxD, {
                            type: 'doughnut',
                            data: {
                                labels: vector['opciones'],
                                datasets: [{
                                    data: vector['votos'],
                                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
                                }]
                            },
                            options: {
                                /*title: {
                                    responsive: true,
                                    display: true,
                                    fontSize: 10,
                                    text: vector['titulo'] // aquí va el titulo de la pregunta
                                }*/
                            }
                        });

                        //$('#div-resultado h4').text(vector['titulo']);
                        /*
                    
                    new Chart(document.getElementById("bar-chart").getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: vector['opciones'],
                            datasets: [
                                {
                                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                                data: vector['votos']
                                }
                            ]
                        },
                        options: {
                        scales: {
                            yAxes: [{
                                display: true,    
                                ticks: {
                                    suggestedMin: 0}
                            }]},
                        responsive: true,
                        title: {
                            display: true,
                            fontSize: 25,
                            text: vector['titulo'] // aquí va el titulo de la pregunta
                        }
                        }
                    });*/ 
                },
                error: function()
                {
                    console.log("Error");
                }
            })
        
    
})
</script>
@stop
