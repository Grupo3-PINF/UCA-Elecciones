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
						<i class="fas fa fa-lock"></i>
						<span>Acceso</span>
					</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<div class="nav navbar" id="sub-header">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-2">
				<h2><a href="{{url ('/') }}">Portal</a></h2>
			</div>
			@if (Auth::check())
			<div class="hide-desktop">

			</div>
			<div class="hide-mobile col-12 col-sm-10">
				<!-- <button class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i class="fas fa-bars fa-1x"></i></span></button> -->

				<!-- Collapsible content -->
				<!-- <div class="collapse navbar-collapse" id="navbarSupportedContent1"> -->

				<ul class="nav">
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/crearvotacion') ? 'active' : ''}}" href="{{url ('/crearvotacion') }}">Crear votacion</a></li>
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/votar') ? 'active' : ''}}" href="#">Votar</a></li>
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/resultados') ? 'active' : ''}}" href="{{url ('/resultados') }}">Resultados</a></li>
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/rolesgrupos') ? 'active' : ''}}" href="#">Roles y grupos</a></li>
				</ul>

				<!-- </div> -->
				<!-- Collapsible content -->

			</div>
			@endif
		</div>
	</div>
</div>