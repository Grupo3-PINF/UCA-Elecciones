<div id="steps-eleccion" class="hide">
	<div class="row">
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
				<input class="form-control" type="number" value="1" name="tiempo-eleccion">
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
				<label>Grupos no ponderados</label>
				<p>¿Se va a poder ejercer la votación en múltiples grupos?
					<input type="checkbox" name="multiGrupo">
				</p>
				<p>¿Los votantes pertenecientes a mas de un grupo podran adscribirse al grupo que quieran votar?
					<input type="checkbox" name="adscripcion">
				</p>
				<p>¿Se va votar a un porcentaje de candidatos o a un numero determinado? (Selecciona una opcion.)
					Porcentaje: <input class="test1" type="checkbox" name="pon-por">
					Nº candidatos: <input class="test1" type="checkbox" name="pon-num">
				</p>
				<div class="form-group d-none" id="porcentaje">
					<p>Introduzca el porcentaje (Si se daja en blanco, se asigna 70% por defecto):
						<input class="form-control" type="number" name="porCan">
					</p>
				</div>
				<div class="form-group d-none" id="num-det">
					<p>Introduce el numero de candidatos:
						<input class="form-control" type="number" name="numCan">
					</p>
				</div>
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
<script>
	function crearEleccion() {
		let grupos = guardarGruposElecciones();
		let candidatos = guardarCandidatos();
		$.ajax({
			type: 'POST',
			url: "crearvotacion/crearEleccion",
			data: {
				"_token": "{{ csrf_token() }}",
				'grupos': grupos,
				'candidatos': candidatos,
				'fecha-inicio': $('input[name=fecha-eleccion').val(),
				'tiempo-eleccion': $('input[name=tiempo-eleccion').val(),
				'tipo-eleccion': $('select[name=tipo-eleccion] option:selected').text(),
				'multiGrupo': $('input[name=multiGrupo]').is(':checked'),
				'adscripcion': $('input[name=adscripcion]').is(':checked'),
				'pon-por': $('input[name=pon-por]').prop('checked'),
				'pon-num': $('input[name=pon-num]').prop('checked'),
				'porCan':$('input[name=porCan').val(),
				'numCan':$('input[name=numCan').val(),
				'doblevoto': $('input[name=doblevoto]').is(':checked')
			},
			success: function(response) {
				if (response.status) {
					$('#enviar').prop('disabled', true);
					$('#res_message').show();
					$('#res_message').html(response.mensaje);
					$('#msg_div').removeClass('alert-danger');
					$('#msg_div').addClass('alert-success');
					$('#msg_div').removeClass('d-none');
					$('#input-pregunta').slideUp(700);
					setTimeout(function() {
						window.location.reload();
					}, 3000);
				} else {
					window.navigator.vibrate(250)
					$('#res_message').show();
					$('#res_message').html(response.mensaje);
					$('#msg_div').removeClass('alert-success');
					$('#msg_div').addClass('alert-danger');
					$('#msg_div').removeClass('d-none');
				}
			},
		})
	}

	function recibirGruposEleccion() {
		$.ajax({
			type: 'POST',
			url: "crearvotacion/recibirGrupos",
			data: {
				"_token": "{{ csrf_token() }}",
			},
			success: function(response) {
				let grupos = response.grupos;
				for (let i = 0; i < grupos.length; i++) {
					if (typeof grupos[i] != "undefined") {
						let nombre = grupos[i].nombre;
						let id = grupos[i].id;
						let html = '<option value="' + id + '">' + nombre + '</option>';
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
			let nombre = $('select[name=grupos-eleccion] option:selected').text();
			let id = $('select[name=grupos-eleccion]').val();
			let html = '<input class="input-div-caja-eleccion" type="text" name="grupo-' + id + '" placeholder="' + nombre + '" readonly><a name="borrar-' + id + '" onclick="borrarInputEleccion(\'' + id + '\',\'grupo\')"><i class="fas fa-window-close"></i></a>';
			if (!$("#grupos-div-eleccion input[name=grupo-" + id + "]").length)
				$('#grupos-div-eleccion').append(html);
		});
	}

	function guardarGruposElecciones() {
		let arr = [];
		let container = document.querySelectorAll('.input-div-caja-eleccion');
		for (let i = 0; i < container.length; i++) {
			arr.push(container[i].getAttribute('name').replace('grupo-', ''));
		}
		return arr;
	}

	function recibirCandidatos() {
		$.ajax({
			type: 'POST',
			url: "crearvotacion/recibirCandidatos",
			data: {
				"_token": "{{ csrf_token() }}",
			},
			success: function(response) {
				let candidatos = response.candidatos;
				for (let i = 0; i < candidatos.length; i++) {
					if (typeof candidatos[i] != "undefined") {
						let nombre = candidatos[i].nombre;
						let apellido = candidatos[i].apellido;
						let identificador = candidatos[i].identificador;
						let html = '<option value="' + identificador + '">' + nombre + ' ' + apellido + '</option>';
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
			let nombre = $('select[name=candidatos-eleccion] option:selected').text();
			let id = $('select[name=candidatos-eleccion]').val();
			let html = '<input class="input-div-caja-candidato" type="text" name="candidato-' + id + '" placeholder="' + nombre + '" readonly><a name="borrar-' + id + '" onclick="borrarInputEleccion(\'' + id + '\',\'candidato\')"><i class="fas fa-window-close"></i></a>';
			if (!$("#candidatos-div-eleccion input[name=candidato-" + id + "]").length)
				$('#candidatos-div-eleccion').append(html);
		});
	}

	function guardarCandidatos() {
		let arr = [];
		let container = document.querySelectorAll('.input-div-caja-candidato');
		for (let i = 0; i < container.length; i++) {
			arr.push(container[i].getAttribute('name').replace('candidato-', ''));
		}
		return arr;
	}

	function borrarInputEleccion(nombre, tipo) {
		$('input[name=' + tipo + '-' + nombre + ']').remove();
		$('a[name=borrar-' + nombre + ']').remove();
	}

	$(document).ready(function() {
		$("select[name=tipo-eleccion]").change(function() {
			$(this).find("option:selected").each(function() {
				let optionValue = $(this).attr("value");
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

	$('input[name=pon-por]').change(function() {
		if ($(this).prop("checked")) {
			$('#porcentaje').removeClass('d-none');
			$('#num-det').addClass('d-none');
		} else {
			$('#porcentaje').addClass('d-none');
		}
	});
	$('input[name=pon-num]').change(function() {
		if ($(this).prop("checked")) {
			$('#num-det').removeClass('d-none');
			$('#porcentaje').addClass('d-none');
		} else {
			$('#num-det').addClass('d-none');
		}
	});

	$('.test1').change(function() {
		$('.test1').not(this).prop('checked', false);
	});
</script>