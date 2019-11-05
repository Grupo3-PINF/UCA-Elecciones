@extends('header')

@section('login')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<form action="LoginController" method="POST">
				<div class="form-group">
					<input placeholder="Username" type="text" name="username">
					<input placeholder="Password" type="password" name="password">
				</div>
			</form>
		</div>
	</div>
</div>

@stop

@extends('footer')