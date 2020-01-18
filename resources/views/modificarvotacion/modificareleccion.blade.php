<div id="steps-eleccion" class="hide">
	<div class="row">
		<div class="row" id="input-eleccion">
			<div class="col-12">
				<h5>Elección</h5>
				<div class="form-group">
					<label>Título</label>
					<input class="form-control" type="text" name="titulo-eleccion" placeholder="Ponga título a su elección">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="form-group">
					<label>Candidatos para la elección</label>
					<select data-live-search="true" class="form-control selectpicker" name="candidatos-eleccion"></select>
					<a class="btn btn-secondary" id="button-candidatos">Añadir</a>
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
					<select data-live-search="true" class="form-control selectpicker" name="grupos-eleccion"></select>
					<a class="btn btn-secondary" id="button-groups-elecciones">Añadir</a>
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
					<p>
						¿Pueden los usuarios pertenecientes a mas de un grupo emitir un voto por cada uno de sus grupos?
						<label><input class="test2" type="checkbox" name="multiGrupo">Si</label>
						<label><input class="test2" type="checkbox" name="noMultiGrupo">No</label>
					</p>
					<p class="d-none" id="ads">¿Los votantes pertenecientes a mas de un grupo podran adscribirse al grupo que quieran votar?
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
					<p>
						Si deja en blanco la ponderacion de algun grupo, se le asignará una ponderacion por defecto.
					</p>
					<table id="example" class="display" style="width:100%">
						<thead>
							<tr>
								<th>Grupo</th>
								<th>Ponderacion(%)</th>
							</tr>
						</thead>
						<tbody id="ponGrup"></tbody>
					</table>
					<a onclick="ponderarGrupos()" class="btn btn-secondary d-none" id="button-ponderar">Ponderar</a>
				</div>
			</div>

			<hr style="border: 0;
		clear:both;
		display:block;
		width: 96%;               
		background-color: darkgray;
		height: 1px;">

			<div class="col-12 col-md-4 px-4">
				<div class="form-group">
					<label>Votación doble</label>
					<p>¿Se va a poder ejercer doble voto?</p>
					<input type="checkbox" name="doblevoto">
				</div>
			</div>
			<div class="col-12 col-md-4 px-4">
				<div class="form-group">
					<label>Votación secreta</label>
					<p>Las votaciones realizadas serán públicas o no. En una votación secreta el voto es irreversible.
					</p>
					<input type="checkbox" name="secreta-eleccion" id="secreta-eleccion">
				</div>
			</div>
			<div class="col-12 col-md-4 px-4">
				<div class="form-group">
					<label>Tiempo real</label>
					<p>Por defecto, los resultados de una votación solo se pueden ver al terminarse. Esta opción permite que se puedan ver en cualquier momento.</p>
					<input type="checkbox" name="tiempo-real-eleccion" id="tiempo-real-eleccion">
				</div>
			</div>
			<div class="col-12 col-md-4 px-4">
				<div class="form-group">
					<label>Votación anticipada</label>
					<p>Permite seleccionar una fecha de votación anticipada mediante un calendario.</p>
					<input type="checkbox" name="anticipada-eleccion">
				</div>
			</div>
			<div class="col-12 col-md-6 px-4" id="fecha-anticipada-eleccion">
				<div class="form-group">
					<label>Fecha votación anticipada</label>
					<input class="form-control" type="datetime-local" name="fecha-anticipada-eleccion">
				</div>
			</div>
			<div class="col-12 col-md-6 px-4" id="participantes-anticipada-eleccion">
				<div class="form-group">
					<label>Participantes de votación anticipada</label>
					<p>Correos de las cuentas de los votantes que podrán votar de manera anticipada. Separados por ';'</p>
					<input class="form-control" type="text" name="participantes-anticipada-eleccion">
				</div>
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
	function navDetect() { 
		if((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1 ) 
		{
			return 'Opera';
		}
		else if(navigator.userAgent.indexOf("Chrome") != -1 )
		{
			return 'Chrome';
		}
		else if(navigator.userAgent.indexOf("Safari") != -1)
		{
			return 'Safari'
		}
		else if(navigator.userAgent.indexOf("Firefox") != -1 ) 
		{
			return 'Firefox';
		}
		else if((navigator.userAgent.indexOf("MSIE") != -1 ) || (!!document.documentMode == true )) //IF IE > 10
		{
			return 'IE' 
		}  
		else 
		{
			return 'unknown'
		}
    }
	$('#fecha-anticipada-eleccion').hide();
	$('#participantes-anticipada-eleccion').hide();
	$('input[name="anticipada-eleccion"]').click(function() {
		if ($('input[name="anticipada-eleccion"]').prop('checked')) {
			$('#fecha-anticipada-eleccion').show();
			$('#participantes-anticipada-eleccion').show();
		} else {
			$('#fecha-anticipada-eleccion').hide();
			$('#participantes-anticipada-eleccion').hide();
		}
	});

	function crearEleccion() {
		let grupos = guardarGruposElecciones();
		let candidatos = guardarCandidatos();
		let nav = navDetect();
		$.ajax({
			type: 'POST',
			url: "{{route('modvotacion.modificarEleccion')}}",
			data: {
				"_token": "{{ csrf_token() }}",
				'titulo': $('input[name=titulo-eleccion]').val(),
				'grupos': grupos,
				'candidatos': candidatos,
				'fecha-inicio': $('input[name=fecha-eleccion').val(),
				'tiempo-eleccion': $('input[name=tiempo-eleccion').val(),
				'tipo-eleccion': $('select[name=tipo-eleccion] option:selected').text(),
				'multiGrupo': $('input[name=multiGrupo]').is(':checked'),
				'adscripcion': $('input[name=adscripcion]').is(':checked'),
				'pon-por': $('input[name=pon-por]').prop('checked'),
				'pon-num': $('input[name=pon-num]').prop('checked'),
				'porCan': $('input[name=porCan').val(),
				'numCan': $('input[name=numCan').val(),
				'doblevoto': $('input[name=doblevoto]').is(':checked'),
				'navegador' : nav,
				'esTiempoReal': $('input[name=tiempo-real-eleccion]').is(':checked'),
				'esSecreta': $('input[name=secreta-eleccion]').is(':checked'),
				'esAnticipada': $('input[name=anticipada-eleccion]').is(':checked'),
				'fecha-anticipada': $('input[name=fecha-anticipada-eleccion]').val(),
				'votantes-anticipados': $('input[name=participantes-anticipada-eleccion]').val()
			},
			success: function(response) {
				if (response.status) {
					$('#enviar').prop('disabled', true);
					$('#res_message').show();
					$('#res_message').html(response.mensaje);
					$('#msg_div').removeClass('alert-danger');
					$('#msg_div').addClass('alert-success');
					$('#msg_div').removeClass('d-none');
					$('#input-eleccion').slideUp(700);
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
			url: "{{route('modvotacion.recibirGrupos')}}",
			data: {
				"_token": "{{ csrf_token() }}",
			},
			success: function(response) {
				let grupos = response.grupos;
				for (let i = 0; i < grupos.length; i++) {
					if (typeof grupos[i] != "undefined") {
						let nombre = grupos[i].nombre;
						let id = grupos[i].id;
						let html = '<option data-tokens="' + nombre + '" value="' + id + '">' + nombre + '</option>';
						$('select[name=grupos-eleccion]').append(html);
					}
				}
				$('select[name=grupos-eleccion]').selectpicker('refresh');
			},
			error: function(error) {
				console.error(error)
			}
		})
	}

		$('#button-groups-elecciones').click(function() {
			let nombre = $('select[name=grupos-eleccion] option:selected').text();
			let id = $('select[name=grupos-eleccion]').val();
			let pon = 0;
			let html = '<input class="input-div-caja-eleccion" type="text" name="grupo-' + id + '-ponderacion-' + pon + '" placeholder="' + nombre + '" readonly><a name="borrar-' + id + '" onclick="borrarInputEleccion(\'' + id + '\',\'grupo\',\'' + pon + '\')"><i class="fas fa-window-close"></i></a>';
			let html2 = '<tr id="tr-' + id + '" ><td>' + nombre + '</td><td><input type="text" class="input-ponderacion" name="pon-' + pon + '"></td></tr>';
			$('#button-ponderar').removeClass('d-none');
			console.log("Hola");
			if (!$("#grupos-div-eleccion input[name=grupo-" + id + "-ponderacion-" + pon + "]").length) {
				$('#grupos-div-eleccion').append(html);
				$('#ponGrup').append(html2);
			}
	});


	function guardarGruposElecciones() {
		let arr = [];
		let container = document.querySelectorAll('.input-div-caja-eleccion');
		let arr_json = [];
		for (let i = 0; i < container.length; i++) {
			let aux = container[i].getAttribute('name').replace('grupo-', '');
			let grupo = aux.replace(/-.+/, '');
			let ponderacion = aux.replace(/.+-/, '');
			arr_json = {
				"grupo": grupo,
				"ponderacion": ponderacion
			};
			arr.push(arr_json);
		};
		return arr;
	}

	function recibirCandidatos() {
		$.ajax({
			type: 'POST',
			url: "{{route('modvotacion.recibirCandidatos')}}",
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
						let html = '<option data-tokens="' + nombre + " " + apellido + '" value="' + identificador + '">' + nombre + ' ' + apellido + '</option>';
						$('select[name=candidatos-eleccion]').append(html);
					}
				}
				$('select[name=candidatos-eleccion]').selectpicker('refresh');
			},
			error: function(error) {
				console.error(error)
			}
		})
	}

	$('#button-candidatos').click(function() {
			let nombre = $('select[name=candidatos-eleccion] option:selected').text();
			let id = $('select[name=candidatos-eleccion]').val();
			let html = '<input class="input-div-caja-candidato" type="text" name="candidato-' + id + '" placeholder="' + nombre + '" readonly><a name="borrar-' + id + '" onclick="borrarInputEleccion(\'' + id + '\',\'candidato\')"><i class="fas fa-window-close"></i></a>';
			if (!$("#candidatos-div-eleccion input[name=candidato-" + id + "]").length)
				$('#candidatos-div-eleccion').append(html);
	});

	function guardarCandidatos() {
		let arr = [];
		let container = document.querySelectorAll('.input-div-caja-candidato');
		for (let i = 0; i < container.length; i++) {
			arr.push(container[i].getAttribute('name').replace('candidato-', ''));
		}
		return arr;
	}

	function borrarInputEleccion(nombre, tipo, pon) {
		if (tipo == 'grupo') {
			$('input[name=' + tipo + '-' + nombre + '-ponderacion-' + pon + ']').remove();
			$('#tr-' + nombre + '').remove();
			$('a[name=borrar-' + nombre + ']').remove();
			let container = document.querySelectorAll('.input-div-caja-eleccion');
			if (container.length == 0) {
				$('#button-ponderar').addClass('d-none');
			}
		} else {
			$('input[name=' + tipo + '-' + nombre + ']').remove();
			$('a[name=borrar-' + nombre + ']').remove();
		}
	}

	function ponderarGrupos() {
		console.log("losmuetos");
		let grupos = document.querySelectorAll('.input-div-caja-eleccion');
		let ponderaciones = document.querySelectorAll('.input-ponderacion');
		console.log("losmuetos2");
		for (let i = 0; i < grupos.length; ++i) {
			console.log("losmuetos3");
			let pon = ponderaciones[i].value;
			console.log("pon: " + pon);
			let aux = grupos[i].getAttribute('name').replace('grupo-', '');
			let grupo = aux.replace(/-.+/, '');
			let grupoPon = aux.replace(/.+-/, '');
			if (pon != 0) {
				console.log("estoy aqui");
				$('input[name=grupo-' + grupo + '-ponderacion-' + grupoPon + ']').attr("name", 'grupo-' + grupo + '-ponderacion-' + pon + '');
				$('a[name=borrar-' + grupo + ']').attr("onclick", 'borrarInputEleccion(\'' + grupo + '\',\'grupo\',\'' + pon + '\')');
			} else {
				$('input[name=grupo-' + grupo + '-ponderacion-' + grupoPon + ']').attr("name", 'grupo-' + grupo + '-ponderacion-' + 0 + '');
				$('a[name=borrar-' + grupo + ']').attr("onclick", 'borrarInputEleccion(\'' + grupo + '\',\'grupo\',\'' + 0 + '\')');
			}
		}
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

	$('input[name=noMultiGrupo]').change(function() {
		if ($(this).prop("checked")) {
			$('#ads').removeClass('d-none');
		} else {
			$('#ads').addClass('d-none');
		}
	});

	$('input[name=multiGrupo]').change(function() {
		if ($(this).prop("checked")) {
			$('#ads').addClass('d-none');
			$('input[name=adscripcion]').prop("checked", false);
		}
	});

	$('.test2').change(function() {
		$('.test2').not(this).prop('checked', false);
	});
</script>