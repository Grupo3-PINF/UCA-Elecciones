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
                <form action="#" method="POST" class="w-100">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Introduzca el un nombre de usuario. (uxxxxxxx)</label>
                            <input class="form-control" type="text" id="loginroles" placeholder="Username (login)">
                            <button id="bmostrar-roles" type="button" class="btn btn-primary">Mostrar roles del usuario</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <h5 id="troles-si"></h5>
                            <p id ="roles-si"></p>
                            <h5 id="troles-no"></h5>
                            <p id="roles-no"></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input class="form-control" type="text" id="addrol" placeholder="Añada un rol">
                            <button id="baddrol" type="button" class="btn btn-primary">Añadir rol</button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input class="form-control" type="text" id="delrol" placeholder="Elimine un rol">
                            <button id="bdelrol" type="button" class="btn btn-primary">Eliminar rol</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @isset($roles)
            <h4>PINFF</h4>
            @foreach ($roles as $rol)
                <h5>{{$rol}}</h5>   
            @endforeach
        @endisset
    </div>
    <script type="text/javascript">
        $("#addrol").hide();
        $("#baddrol").hide();
        $("#delrol").hide();
        $("#bdelrol").hide();
        $(document).ready(function(){
            $("#bmostrar-roles").click(function(){
                var data = $("#loginroles").val();
                $.ajax({
                    type: 'POST',
                    url: '{{route('roles.mostrar')}}',
                    data:{"login":data,"_token": "{{ csrf_token() }}"},
                    success: function(data) {
                        if(data!="")
                        {
                            $("#troles-si").text("Lista de roles del usuario:");
                            $("#roles-si").text(data);
                            $("#troles-no").text("Lista de roles que NO tiene:");
                            $("#addrol").show();
                            $("#baddrol").show();
                            $("#delrol").show();
                            $("#bdelrol").show();
                            var str="";
                            var cont = 0;
                            if(data.find(function(element){
                                 return element=="Administrador";
                                 })==undefined)
                            {
                                str+="Administrador";
                            }
                            if(data.find(function(element){
                                 return element=="Secretario";
                                 })==undefined)
                            {
                                if(str!="")
                                    str+=",Secretario";
                                else
                                    str+="Secretario";
                            }
                            if(data.find(function(element){
                                 return element=="Estudiante";
                                 })==undefined)
                            {
                                if(str!="")
                                    str+=",Estudiante";
                                else
                                    str+="Estudiante";
                            }
                            if(data.find(function(element){
                                 return element=="Desarrollador Bajo";
                                 })==undefined)
                            {
                                if(str!="")
                                    str+=",Desarrollador Bajo";
                                else
                                    str+="Desarrollador Bajo";
                            }
                            if(data.find(function(element){
                                 return element=="Desarrollador Alto";
                                 })==undefined)
                            {
                                if(str!="")
                                    str+=",Desarrollador Alto";
                                else
                                    str+="Desarrollador Alto";
                            }
                            $("#roles-no").text(str);
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
                        $('#bmostrar-roles').trigger('click');
                        $('#delrol').val("");
                    }
                });
            });                                   
        });
    </script>
@endsection
