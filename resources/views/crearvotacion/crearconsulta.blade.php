<div id="steps-consulta" class="hide">
	<div class="row">
		<div class="col-12">
			<h5>Consulta</h5>
			<div class="form-group">
				<label>Tipo de consulta</label>
				<select class="form-control" name="tipo-consulta" id="tipo-consulta">
					<option value="pregunta">Pregunta</option>
					<option value="eleccion">Eleccion</option>
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="button" onclick="consulta()">Enviar</button>
				<a class="btn btn-cancel" href="{{url('/crearvotacion')}}">Cancelar</a>
			</div>
		</div>
	</div>
</div>