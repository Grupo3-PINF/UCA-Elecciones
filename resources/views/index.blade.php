<?php $titulo = "Home"; ?>
@extends('layouts/layout')
@section('content')
<div id="home">
	<div id="carousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel" data-slide-to="0" class="active"></li>
			<li data-target="#carousel" data-slide-to="1"></li>
			<li data-target="#carousel" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
			  <img class="d-block w-100" src="{{asset('/images/slide1.jpg')}}" alt="Primer elemento">
			</div>
			<div class="carousel-item">
			  <img class="d-block w-100" src="{{asset('/images/slide2.jpg')}}" alt="Segundo elemento">
			</div>
			<div class="carousel-item">
			  <img class="d-block w-100" src="{{asset('/images/slide3.jpg')}}" alt="Tercer elemento">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3>Lorem Ipsum</h3>
			</div>
		</div>
	</div>
</div>
@stop
