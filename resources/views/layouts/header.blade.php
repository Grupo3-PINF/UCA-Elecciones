<div class="nav navbar" id="header">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1><a href="{{url ('/login') }}">Universidad<span>de</span>Cádiz</a></h1>
			</div>
		</div>
	</div>
</div>
@if (Auth::check())
<div class="nav navbar" id="sub-header">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-4">
				<h2><a href="{{url ('/index') }}">Votaciones</a></h2>
			</div>
			<div class="col-xs-12 col-8">
				<ul class="nav">
					<li class="nav-item"><a class="nav-link active" href="#">Carlos</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Josemi</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Yisus</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Coco</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Heredia</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
@endif