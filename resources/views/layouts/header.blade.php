<div class="nav navbar" id="header">
	<div class="container">
		<div class="row w-100">
			<div class="col-12 col-sm-6">
				<h1><a href="{{url ('/') }}">Universidad<span>de</span>Cádiz</a></h1>
			</div>
			<div class="col-12 col-sm-2 offset-sm-4">
				<div class="header-icons">
					@if (Auth::check())
					<a href="{{url ('/logout') }}">
						<span>Cerrar sesión</span>
						<i class="fas fa-sign-out-alt"></i>
					</a>
					@else
					<a href="{{url ('/login') }}">
						<span>Iniciar sesión</span>
						<i class="fas fa-sign-in-alt"></i>
					</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

{{--@if (Auth::check())--}}

<div class="nav navbar" id="sub-header">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-2">
				<h2><a href="{{url ('/') }}">Portal</a></h2>
			</div>
			<div class="col-12 col-sm-10">
				<ul class="nav">
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/crearvotacion') ? 'active' : ''}}" href="crearvotacion">Crear votacion</a></li>
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/votar') ? 'active' : ''}}" href="#">Votar</a></li>
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/resultados') ? 'active' : ''}}" href="#">Resultados</a></li>
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/rolesgrupos') ? 'active' : ''}}" href="#">Roles y grupos</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
{{--@endif--}}