<?php $titulo = "Crear votacion"; ?>
@extends('layouts/layout')
@section('content')
    <div id="roles">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>ROLES DE LOS USUARIOS</h3>
                    <p>Este panel de gestión puede mostrar los roles a los que pertenece un determinado usuario, además de añadir o eliminar nuevos roles.</p>
                </div>
            </div>
            <form action="#" method="POST" class="w-100">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Introduzca un nombre de usuario. (uxxxxxxx)</label>
                            <input class="form-control" type="text" id="loginroles" placeholder="Username (login)">
                            <button id="bmostrar-roles" type="button" class="btn btn-primary">Mostrar roles</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div id="roles-si" class="form-group">
                            <table class="table">
                                <thead></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div id="roles-no" class="form-group">
                            <table class="table">
                                <thead></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="acciones-rol" class="hide">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Añadir un rol al usuario</label>
                                <input class="form-control" type="text" id="addrol" placeholder="Añada un rol">
                                <button id="baddrol" type="button" class="btn btn-primary">Añadir</button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Elimine un rol al usuario</label>
                                <input class="form-control" type="text" id="delrol" placeholder="Elimine un rol">
                                <button id="bdelrol" type="button" class="btn btn-primary">Eliminar</button>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Modificar un rol al usuario</label>
                                <input class="form-control" type="text" id="modrol" placeholder="Modificar un rol">
                                <button id="bmodrol" type="button" class="btn btn-primary">Modificar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @isset($roles)
            <h4>PINFF</h4>
            @foreach ($roles as $rol)
                <h5>{{$rol}}</h5>   
            @endforeach
        @endisset
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#bmostrar-roles").click(function(){
                var data = $("#loginroles").val();
                $.ajax({
                    type: 'POST',
                    url: '{{route('roles.mostrar')}}',
                    data:{"login":data,"_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        if(data != "Sin roles")
                        {
                            $("#roles-si thead").append("<tr><th>Lista de roles del usuario</th></tr>");
                            $("#roles-si tbody").append("<tr><td>" + data + "</td></tr>");
                            $("#roles-no thead").append("<tr><th>Lista de roles que NO tiene</th></tr>");
                            $("#acciones-rol").toggleClass("hide");

                            if(data.find(function(element){
                                 return element=="Administrador";
                                 })==undefined)
                            {
                                $("#roles-no tbody").append("<tr><td>Administrador</td></tr>");
                            }
                            if(data.find(function(element){
                                 return element=="Secretario";
                                 })==undefined)
                            {
                                $("#roles-no tbody").append("<tr><td>Secretario</td></tr>");
                            }
                            if(data.find(function(element){
                                 return element=="Estudiante";
                                 })==undefined)
                            {
                                $("#roles-no tbody").append("<tr><td>Estudiante</td></tr>");
                            }
                            if(data.find(function(element){
                                 return element=="Desarrollador Bajo";
                                 })==undefined)
                            {
                                $("#roles-no tbody").append("<tr><td>Desarrollador bajo</td></tr>");
                            }
                            if(data.find(function(element){
                                 return element=="Desarrollador Alto";
                                 })==undefined)
                            {
                                $("#roles-no tbody").append("<tr><td>Desarrollador alto</td></tr>");
                            }
                        }
                    }
                });
            });
            $("#baddrol").click(function()
            {
                var data = ["",$("#addrol").val()];
                $.ajax({
                    type : 'POST',
                    url : '{{route('roles.agregar')}}',
                    data: {"roles":data,"_token": "{{ csrf_token() }}"},
                    success: function(data){
                        alert(data);
                        $("#roles-si thead").html("");
                        $("#roles-si tbody").html("");
                        $("#roles-no thead").html("");
                        $("#roles-no tbody").html("");
                        $("#acciones-rol").toggleClass("hide");
                        $('#bmostrar-roles').trigger('click');
                        $('#addrol').val("");
                    }
                });
            });
            $("#bdelrol").click(function()
            {
                var data = ["",$("#delrol").val()];
                $.ajax({
                    type : 'POST',
                    url : '{{route('roles.eliminar')}}',
                    data: {"roles":data,"_token": "{{ csrf_token() }}"},
                    success: function(data){
                        alert(data);
                        $("#roles-si thead").html("");
                        $("#roles-si tbody").html("");
                        $("#roles-no thead").html("");
                        $("#roles-no tbody").html("");
                        $("#acciones-rol").toggleClass("hide");
                        $('#bmostrar-roles').trigger('click');
                        $('#delrol').val("");

                    }
                });
            });
            $("#bmodrol").click(function()
            {
                var data = $("#modrol").val();
                $.ajax({
                    type: 'POST',
                    url: '{{route('roles.modificar')}}',
                    data: {"rol":data,"_token": "{{ csrf_token() }}"},
                    success: function(data)
                    {
                        alert(data);
                        $("#roles-si thead").html("");
                        $("#roles-si tbody").html("");
                        $("#roles-no thead").html("");
                        $("#roles-no tbody").html("");
                        $("#acciones-rol").toggleClass("hide");
                        $('#bmostrar-roles').trigger('click');
                        $('#modqrol').val("");
                    }
                })
            });                               
        });
    </script>
@endsection
