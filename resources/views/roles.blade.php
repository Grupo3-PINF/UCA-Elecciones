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
                            <button type="button" class="btn btn-success btn-submit">Mostrar roles del usuario</button>
                            <h5></h5>
                            <p></p>
                        </div>
                       <script type="text/javascript">
                            $(document).ready(function(){
                                $("button").click(function(){
                                    var data = $("#loginroles").val();
                                    $.ajax({
                                        type: 'POST',
                                        url: '/roles-mostrar',
                                        data:{"login":data,"_token": "{{ csrf_token() }}"},
                                        success: function(data) {
                                            $("h5").text("Lista de roles del usuario:")
                                            $("p").text(data);
                        
                                        }
                                    });
                           });
                        });
                        </script>
                    </div>
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