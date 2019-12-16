<div id="steps-eleccion" class="hide">
	<div class="row">
		<div id="1" class="row">
			<div class="col-12">
				<h5>Elección</h5>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label>Candidatos para la elección</label>
					<select class="form-control" name="candidatos-eleccion"></select>
					<a onclick="anadirCandidatos();" class="btn btn-secondary" id="button-candidatos">Añadir</a>
					<input type="hidden" name="buscador-candidatos">
				</div>
			</div>
			<div class="col-12 col-md-8">
				<div class="form-group">
					<label>Lista de candidatos</label>
					<div class="w-100" id="candidatos-div-eleccion"></div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label>Grupos participantes</label>
					<select class="form-control" name="grupos-eleccion"></select>
					<a onclick="anadirGruposElecciones();" class="btn btn-secondary" id="button-groups-elecciones">Añadir</a>
				</div>
			</div>
			<div class="col-12 col-md-8">
				<div class="form-group">
					<label>Lista de grupos</label>
					<div class="w-100" id="grupos-div-eleccion"></div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label>Fecha de la elección</label>
					<p>Fecha y hora del comienzo de la votación. </p>
					<input class="form-control" type="datetime-local" name="fecha-eleccion">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label>Duración de votación (minutos)</label>
					<p>Tiempo máximo para realizar la votación una vez abierta</p>
					<input class="form-control" type="number" placeholder="10 minutos">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label>Tipo de elección</label>
					<select class="form-control" name="tipo-eleccion">
						<option value="1" selected>Delegados</option>
						<option value="2">Grupos no ponderados</option>
						<option value="3">Cargos unipersonales</option>
					</select>
				</div>
			</div>
			<div class="col-12 col-md-6" id="grupos-no-ponderados">
				<div class="form-group">
					<label>Tipo de votación</label>
					<select class="form-control" id="tipo-votacion">
						<option>Solo un grupo</option>
						<option>Multiple</option>
						<option>Adscripción a grupos</option>
					</select>
				</div>
			</div>
			<div class="col-12" id="cargos-unipersonales">
				<div class="form-group">
					<label>Cargos unipersonales</label>
				</div>
			</div>
			<div class="col-12">
				<div class="form-group">
					<label>Votación doble</label>
					<p>¿Se va a poder ejercer doble voto?
						<input type="checkbox" name="doblevoto">
					</p>
				</div>
			</div>
		</div>
		<div class="row" id="2">
			<div class="col-12">
				<div class="alert alert-success d-none" id="msg_div">
					<span id="res_message"></span>
				</div>
				<div class="form-group">
					<button onclick="crearEleccion()" id="enviar" class="btn btn-primary">Enviar</button>
					<a class="btn btn-cancel" id="cancelar" href="{{url('/crearvotacion')}}">Cancelar</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function crearEleccion() {
		$.ajax({
			type: 'POST',
			url: "crearvotacion/crearEleccion",
			data: {
				"_token": "{{ csrf_token() }}",
			},
			success: function(response) {
				$('#enviar').prop('disabled', true);
				$('#res_message').show();
				$('#res_message').html(response.mensaje);
				$('#msg_div').removeClass('d-none');
				$('#1').slideUp(700);
				setTimeout(function(){
					window.location.reload();
				},3000);
			},
			error: function(error) {
				console.error(error)
			}
		})
	}

	function borrarInputEleccion(nombre, tipo) {
		$('input[name=' + tipo + '-' + nombre + ']').remove();
		$('a[name=borrar-' + nombre + ']').remove();
	}

	function recibirGruposEleccion() {
		$.ajax({
			type: 'POST',
			url: "crearvotacion/recibirGrupos",
			data: {
				"_token": "{{ csrf_token() }}",
			},
			success: function(response) {
				var grupos = response.grupos;
				for (var i = 0; i < grupos.length; i++) {
					if (typeof grupos[i] != "undefined") {
						console.log(grupos[i].nombre);
						var nombre = grupos[i].nombre;
						var id = grupos[i].id;
						var html = '<option value="' + id + '">' + nombre + '</option>';
						$('select[name=grupos-eleccion]').append(html);
					}
				}
			},
			error: function(error) {
				console.error(error)
			}
		})
	}

	function anadirGruposElecciones() {
		$('#button-groups-elecciones').click(function() {
			var nombre = $('select[name=grupos-eleccion] option:selected').text();
			var id = $('select[name=grupos-eleccion]').val();
			var html = '<input class="input-div-caja" type="text" name="grupo-' + id + '" placeholder="' + nombre + '" readonly><a name="borrar-' + id + '" onclick="borrarInputEleccion(\'' + id + '\',\'grupo\')"><i class="fas fa-window-close"></i></a>';
			if (!$("#grupos-div-eleccion input[name=grupo-" + id + "]").length)
				$('#grupos-div-eleccion').append(html);
		});
	}

	function recibirCandidatos() {
		$.ajax({
			type: 'POST',
			url: "crearvotacion/recibirCandidatos",
			data: {
				"_token": "{{ csrf_token() }}",
			},
			success: function(response) {
				var candidatos = response.candidatos;
				for (var i = 0; i < candidatos.length; i++) {
					if (typeof candidatos[i] != "undefined") {
						var nombre = candidatos[i].nombre;
						var apellido = candidatos[i].apellido;
						var identificador = candidatos[i].identificador;
						var html = '<option value="' + identificador + '">' + nombre + ' ' + apellido + '</option>';
						$('select[name=candidatos-eleccion]').append(html);
					}
				}
			},
			error: function(error) {
				console.error(error)
			}
		})
	}

	function anadirCandidatos() {
		$('#button-candidatos').click(function() {
			var nombre = $('select[name=candidatos-eleccion] option:selected').text();
			var id = $('select[name=candidatos-eleccion]').val();
			var html = '<input class="input-div-caja" type="text" name="candidato-' + id + '" placeholder="' + nombre + '" readonly><a name="borrar-' + id + '" onclick="borrarInputEleccion(\'' + id + '\',\'candidato\')"><i class="fas fa-window-close"></i></a>';
			if (!$("#candidatos-div-eleccion input[name=candidato-" + id + "]").length)
				$('#candidatos-div-eleccion').append(html);
		});
	}

	$(document).ready(function() {
		$("select[name=tipo-eleccion]").change(function() {
			$(this).find("option:selected").each(function() {
				var optionValue = $(this).attr("value");
				if (optionValue == 2) {
					$('#grupos-no-ponderados').show();
					$('#cargos-unipersonales').hide();
				} else if (optionValue == 3) {
					$('#cargos-unipersonales').show();
					$('#grupos-no-ponderados').hide();
				} else {
					$('#cargos-unipersonales').hide();
					$('#grupos-no-ponderados').hide();
				}
			});
		}).change();
	});
</script>