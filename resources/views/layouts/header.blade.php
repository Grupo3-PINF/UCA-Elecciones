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
		<div class="row w-100">
			<div class="col-5 col-md-2">
				<h2><a href="{{url ('/') }}">Portal</a></h2>
			</div>
			@if (Auth::check())
			<div class="col-3 offset-4 hide-desktop">
				<button class="hamburger hamburger--elastic js-hamburguer navbar-toggle is-active" type="button" data-toggle="collapse" data-target=".navbar-collapse" id="hamburger-menu">
			        <span class="hamburger-box">
			            <span class="hamburger-inner"></span>
			        </span>
			    </button>
			</div>
			<div class="collapse show navbar-collapse hide-desktop" id="burger-div">
				<ul class="list-group">
					@if(Session::has('rolusuario') && Session::get('rolusuario') == "secretario")
						<li class="list-group-item"><a class="nav-link {{Request::url() === url ('/crearvotacion') ? 'active' : ''}}" href="{{url ('/crearvotacion') }}">Crear votacion</a></li>
						<li class="list-group-item"><a class="nav-link {{Request::url() === url ('/modificarvotacion') ? 'active' : ''}}" href="{{url ('/modificarvotacion') }}">Modificar votacion</a></li>
						<li class="list-group-item"><a class="nav-link {{Request::url() === url ('/borrarvotacion') ? 'active' : ''}}" href="{{url ('/borrarvotacion') }}">Borrar votacion</a></li>
					@endif
					@if(Session::has('rolusuario') && Session::get('rolusuario') == "administrador")
						<li class="list-group-item"><a class="nav-link {{Request::url() === url ('/roles') ? 'active' : ''}}" href="{{url ('/roles') }}">Roles y grupos</a></li>
					@endif
					<li class="list-group-item"><a class="nav-link {{Request::url() === url ('/accesovotaciones') ? 'active' : ''}}" href="{{url ('/accesovotaciones') }}">Votar</a></li>
					<li class="list-group-item"><a class="nav-link {{Request::url() === url ('/resultados') ? 'active' : ''}}" href="{{url ('/resultados') }}">Resultados</a></li>
				</ul>
			</div>
			<div class="col-12 col-sm-10 hide-mobile">
				<ul class="nav">
					@if(Session::has('rolusuario') && Session::get('rolusuario') == "secretario")
						<li class="nav-item"><a class="nav-link {{Request::url() === url ('/crearvotacion') ? 'active' : ''}}" href="{{url ('/crearvotacion') }}">Crear votacion</a></li>
						<li class="nav-item"><a class="nav-link {{Request::url() === url ('/modificarvotacion') ? 'active' : ''}}" href="{{url ('/modificarvotacion') }}">Modificar votacion</a></li>
						<li class="nav-item"><a class="nav-link {{Request::url() === url ('/borrarvotacion') ? 'active' : ''}}" href="{{url ('/borrarvotacion') }}">Borrar votacion</a></li>
					@endif
					@if(Session::has('rolusuario') && Session::get('rolusuario') == "administrador")
						<li class="nav-item"><a class="nav-link {{Request::url() === url ('/roles') ? 'active' : ''}}" href="{{url ('/roles') }}">Roles y grupos</a></li>
					@endif
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/accesovotaciones') ? 'active' : ''}}" href="{{url ('/accesovotaciones') }}">Votar</a></li>
					<li class="nav-item"><a class="nav-link {{Request::url() === url ('/resultados') ? 'active' : ''}}" href="{{url ('/resultados') }}">Resultados</a></li>
				</ul>

				<!-- </div> -->
				<!-- Collapsible content -->

			</div>
			@endif
		</div>
	</div>
</div>
<script>
	var $hamburger = $(".hamburger");
	$hamburger.on("click", function(e) {
    	$hamburger.toggleClass("is-active");
  	});
</script>