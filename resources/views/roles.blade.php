<?php $titulo = "Crear votacion"; ?>
@extends('layouts/layout')
@section('content')
    <div id="roles">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>ROLES DE LOS USUARIOS</h3>
                    <form>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" id="loginroles">
                                <button id="bmostrar-roles" type="button" class="btn btn-primary">Mostrar roles del usuario</button>
                                <h5 id="troles-si"></h5>
                                <p id ="roles-si"></p>
                                <h5 id="troles-no"></h5>
                                <p id="roles-no"></p>
                                <input type="text" id="addrol">
                                <button id="baddrol" type="button" class="btn btn-primary">Añadir rol</button>
                                <input type="text" id="delrol">
                                <button id="bdelrol" type="button" class="btn btn-primary">Eliminar rol</button>
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
                                                url: '/roles-mostrar',
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
                                                url : 'roles-añadir',
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
                                                url : 'roles-eliminar',
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
                            </div>
                        </div>
                        <div class="col-12">

                    </form>
                </div>
            </div>
        </div>
        @isset($roles)
            <h4>PINFF</h4>
            @foreach ($roles as $rol)
                <h5>{{$rol}}</h5>   
            @endforeach
        @endisset
    </div>
@endsection
