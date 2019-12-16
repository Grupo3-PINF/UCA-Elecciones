	@if(Route::current()->getName() != 'login')
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-5">
					<img src="{{asset('/images/logoUCA40_blanco.png')}}" alt="logo-uca" class="img-fluid">
				</div>
				<div class="col-6 col-sm-3 offset-sm-1">
					<span><a target="_blank" href="{{url ('/avisolegal') }}">Aviso legal</a></span>
					<span><a target="_blank" href="{{url ('/accesibilidad') }}">Accesibilidad</a></span>
					<span><a target="_blank" href="{{url ('/cookies') }}">Cookies</a></span>
				</div>
				<div class="col-6 col-sm-3">
					<span><a target="_blank" href="https://www.uca.es/">UCA</a></span>
					<span><a target="_blank" href="https://campusvirtual.uca.es/">Campus</a></span>
				</div>
			</div>
		</div>
	</footer>
	@endif

	</html>