<div id="steps-eleccion" class="hide">
	<div class="row">
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
				<select class="form-control" name="candidatos-eleccion">
					<option value="FranSoto">Fran Soto</option>
					<option value="AntonioBF">Antonio BF</option>
					<option value="CarlosRioja">Carlos Rioja</option>
				</select>
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
				<select class="form-control" name="grupos-eleccion">
					<option value="alumnos">Alumnos</option>
					<option value="profesores">Profesores</option>
					<option value="todos">Todos</option>
				</select>
				<a onclick="anadirGruposElecciones();" class="btn btn-secondary" id="button-groups-elecciones">Añadir</a>
			</div>
		</div>
		<div class="col-12 col-md-8">
			<div class="form-group">
				<label>Lista de candidatos</label>
				<div class="w-100" id="grupos-div-eleccion"></div>
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Fecha de la elección</label>
				<input class="form-control" type="date" name="fecha-eleccion">
			</div>
		</div>
		<div class="col-12 col-md-4">
			<div class="form-group">
				<label>Tipo de elección</label>
				<select class="form-control" name="tipo-eleccion">
					<option value="1" selected="true">Delegados</option>
					<option value="2">Grupos no ponderados</option>
					<option value="3">Cargos unipersonales</option>
				</select>
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