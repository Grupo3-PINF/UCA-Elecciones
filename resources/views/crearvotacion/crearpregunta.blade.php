<div id="steps-pregunta" class="hide">
	<div class="row">
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
				<label>Simple o compleja</label>
				<p>Preguntas simples serán sí, no o abstenerse</p>
				<select class="form-control" name="tipo-pregunta">
					<option value="1">Simple</option>
					<option value="2">Compleja</option>
				</select>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Tiempo de votación (minutos)</label>
				<p>Tiempo máximo para realizar la votación una vez abierta</p>
				<input class="form-control" type="number" value="1">
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
		<div class="col-12">
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Enviar</button>
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
			var html = '<input class="input-div-caja" type="text" name="grupo-' + id + '" placeholder="' + nombre + '" readonly><a name="borrar-' + id + '" onclick="borrarInputPregunta(\'' + id + '\',\'grupo\')"><i class="fas fa-window-close"></i></a>';
			if (!$("#grupos-div-pregunta input[name=grupo-" + id + "]").length)
				$('#grupos-div-pregunta').append(html);
		});
	}

	function borrarInputPregunta(nombre, tipo) {
		$('input[name=' + tipo + '-' + nombre + ']').remove();
		$('a[name=borrar-' + nombre + ']').remove();
	}
</script>