	@if(Route::current()->getName() != 'login')
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-5">
					<img src="{{asset('/images/logoUCA40_blanco.png')}}" alt="logo-uca" class="img-fluid">
				</div>
				<div class="col-6 col-sm-3 offset-sm-1">
					<span><a href="#">Aviso legal</a></span>
					<span><a href="#">Accesibilidad</a></span>
					<span><a href="#">Cookies</a></span>
				</div>
				<div class="col-6 col-sm-3">
					<span><a href="https://www.uca.es/">UCA</a></span>
					<span><a href="https://campusvirtual.uca.es/">Campus</a></span>
				</div>
			</div>
		</div>
	</footer>
	@endif
</html>