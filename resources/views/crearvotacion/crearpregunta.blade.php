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
				<select class="form-control" name="grupos-pregunta">
					<option value="alumnos">Alumnos</option>
					<option value="profesores">Profesores</option>
					<option value="todos">Todos</option>
				</select>
				<a onclick="anadirGrupos();" class="btn btn-secondary" id="button-groups">Añadir</a>
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