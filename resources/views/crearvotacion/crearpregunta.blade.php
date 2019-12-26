<div id="steps-pregunta" class="hide">
	<div class="row">
	<div class="row" id="input-pregunta">
		<div class="col-12">
			<h5>Pregunta</h5>
			<div class="form-group">
				<label>Título</label>
				<p>¿Cuál será la pregunta?</p>
				<input class="form-control" type="text" name="titulo-pregunta" placeholder="Ponga título a su pregunta">
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Grupos con permiso para votar</label>
				<p>Censos que pueden participar en esta pregunta.</p>
				<select class="form-control" name="grupos-pregunta"></select>
				<a onclick="anadirGruposPregunta();" class="btn btn-secondary" id="button-groups">Añadir</a>
				<input type="hidden" name="buscador-grupos">
			</div>
		</div>
		<div class="col-12 col-md-8">
			<div class="form-group">
				<label>Lista de grupos</label>
				<p>Grupos participantes en la votación, click para eliminar.</p>
				<div class="w-100" id="grupos-div-pregunta"></div>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Fecha de la votación</label>
				<p>Fecha de la votación en formato dd/mm/yyyy H:i</p>
				<input class="form-control" type="datetime-local" name="fecha-pregunta">
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Pregunta compleja</label>
				<p>Por defecto, las respuestas serán sí, no o abstenerse. Que sea compleja permite editar las posibles respuestas.</p>
				<input type="checkbox" name="compleja-pregunta" id="checkbox-compleja" onchange=cambioCompleja(this)>
				<div id="opciones-compleja" hidden>
					<ol id="lista-compleja">
						<li><input type="text" onblur="eliminarVacios(this)"></li>
						<li><input type="text" onblur="eliminarVacios(this)" onfocus="nuevoInput(this)"></li>
					</ol>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Tiempo de votación (minutos)</label>
				<p>Tiempo máximo para realizar la votación una vez abierta</p>
				<input class="form-control" type="number" value="1" name="tiempo-pregunta">
			</div>
		</div>
		<div class="col-12 col-md-3">
			<div class="form-group">
				<label>Votación anticipada</label>
				<p>Permite seleccionar una fecha de votación anticipada mediante un calendario.</p>
				<input type="checkbox" name="anticipada-pregunta">
			</div>
		</div>
		<div class="col-12 col-md-3">
			<div class="form-group">
				<label>Votación secreta</label>
				<p>Las votaciones realizadas serán públicas o no. En una votación secreta el voto es irreversible.</p>
				<input type="checkbox" name="secreta-pregunta">
			</div>
		</div>
		<div class="col-12 col-md-6">
		</div>
		<div class="col-12 col-md-6" id="fecha-anticipada-pregunta">
			<div class="form-group">
				<label>Fecha votación anticipada</label>
				<input class="form-control" type="datetime-local" name="fecha-anticipada-pregunta">
			</div>
		</div>
		<div class="col-12 col-md-6" id="participantes-anticipada-pregunta">
			<div class="form-group">
				<label>Participantes de votación anticipada</label>
				<input class="form-control" type="text" name="participantes-anticipada-pregunta">
			</div>
		</div>
	</div>
		<div class="col-12">
			<div class="alert d-none" id="msg_div">
				<span id="res_message"></span>
			</div>
			<div class="form-group">
				<button onclick="crearPregunta()" id="enviar" class="btn btn-primary">Enviar</button>
				<a class="btn btn-cancel" href="{{url('/crearvotacion')}}">Cancelar</a>
			</div>
		</div>
	</div>
</div>

<script>
	$('input[name="anticipada-pregunta"]').click(function() {
		if ($('input[name="anticipada-pregunta"]').prop('checked')) {
			$('#fecha-anticipada-pregunta').show();
			$('#participantes-anticipada-pregunta').show();
		} else {
			$('#fecha-anticipada-pregunta').hide();
			$('#participantes-anticipada-pregunta').hide();
		}
	});

	function cambioCompleja(checkbox) {
		let div = document.getElementById("opciones-compleja");
		if (checkbox.checked) {
			div.hidden = false;
		} else {
			div.hidden = true;
		}
	}

	function nuevoInput(opcion) {
		let lista = opcion.parentElement.parentElement;
		let opciones = lista.children;

		if (opcion.parentElement === opciones[opciones.length - 1]) {
			let nueva = document.createElement('li');
			nueva.innerHTML = '<input type="text" onblur=eliminarVacios(this) onfocus="nuevoInput(this)">';
			lista.appendChild(nueva);
		}
	}

	function eliminarVacios(opcion) {
		let lista = opcion.parentElement.parentElement;
		let opciones = lista.children;
		let count = opciones.length;
		for (let i = opciones.length - 2; i >= 0; --i) {
			if (opciones[i].firstChild.value === "" && count > 2) {
				opciones[i].remove();
				--count;
			}
		}
	}

	function guardarGruposPregunta() {
		var arr = [];
		var container = document.querySelectorAll('.input-div-caja-pregunta');
		for (var i = 0; i < container.length; i++) {
			arr.push(container[i].placeholder);
		}
		console.log(arr);
		return arr;
	}

	function crearPregunta() {
		var grupos = guardarGruposPregunta();
		$.ajax({
			type: 'POST',
			url: "crearvotacion/crearPregunta",
			data: {
				"_token": "{{ csrf_token() }}",
				'titulo': $('input[name=titulo-pregunta]').val(),
				'grupos': grupos,
				'es-compleja': $('input[name=compleja-pregunta]').is(':checked'),
				'fecha-inicio': $('input[name=fecha-pregunta]').val(),
				'tiempo-pregunta': $('input[name=tiempo-pregunta]').val(),
				'es-anticipada': $('input[name=anticipada-pregunta]').is(':checked'),
				'es-secreta': $('input[name=secreta-pregunta]').is(':checked'),
				'fecha-pregunta-anticipada': $('input[name=fecha-anticipada-pregunta]').val()
			},
			success: function(response) {
				console.log(response.status);
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
			error: function(error) {
				console.error(error)
			}
		})
	}

	function recibirGruposPregunta() {
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
						$('select[name=grupos-pregunta]').append(html);
					}
				}
			},
			error: function(error) {
				console.error(error)
			}
		})
	}

	function anadirGruposPregunta() {
		$('#button-groups').click(function() {
			var nombre = $('select[name=grupos-pregunta] option:selected').text();
			var id = $('select[name=grupos-pregunta]').val();
			var html = '<input class="input-div-caja-pregunta" type="text" name="grupo-' + id + '" placeholder="' + nombre + '" readonly><a name="borrar-' + id + '" onclick="borrarInputPregunta(\'' + id + '\',\'grupo\')"><i class="fas fa-window-close"></i></a>';
			if (!$("#grupos-div-pregunta input[name=grupo-" + id + "]").length)
				$('#grupos-div-pregunta').append(html);
		});
	}

	function borrarInputPregunta(nombre, tipo) {
		$('input[name=' + tipo + '-' + nombre + ']').remove();
		$('a[name=borrar-' + nombre + ']').remove();
	}
</script>