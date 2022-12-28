@extends('layouts.app')
@section('clase-active-inicio', 'active')
@section('content')
			<!-- begin breadcrumb -->
			{{--<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item active"><a href="javascript:;">Inicio</a></li>
			</ol>--}}
			<!-- end breadcrumb -->
			<!-- begin page-header -->
{{--
			<h1 class="page-header">Inicio </h1>
--}}
			<!-- end page-header -->

			<!-- begin panel -->
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
					<h4 class="panel-title">GreEngField</h4>
				</div>
				<div class="panel-body">
					{{--<p class="text-center"><img src="{{asset('assets/img/logo/logo.jpg')}}" alt="" style="width: 35%"></p>--}}
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
							<!-- Slide One - Set the background image for this slide in the line below -->
							<div class="carousel-item active" style="background-image: url('https://greendfield.com/assets/img/slider/slider_1.jpg')">

							</div>
							<!-- Slide Two - Set the background image for this slide in the line below -->
							<div class="carousel-item" style="background-image: url('https://greendfield.com/assets/img/slider/slider_2.jpg')">
								{{--<div class="carousel-caption d-none d-md-block">
									<h3 class="display-4">Second Slide</h3>
									<p class="lead">This is a description for the second slide.</p>
								</div>--}}
							</div>
							<!-- Slide Three - Set the background image for this slide in the line below -->
							<div class="carousel-item" style="background-image: url('https://greendfield.com/assets/img/slider/slider_3.jpg')">

							</div>
							<div class="carousel-item" style="background-image: url('https://greendfield.com/assets/img/slider/slider_4.jpg')">

							</div>
							<div class="carousel-item" style="background-image: url('https://greendfield.com/assets/img/slider/slider_5.jpg')">

							</div>
							<div class="carousel-item" style="background-image: url('https://greendfield.com/assets/img/slider/slider_6.jpg')">

							</div>
							<div class="carousel-item" style="background-image: url('https://greendfield.com/assets/img/slider/slider_7.jpg')">

							</div>


						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</div>
			<!-- end panel -->

@endsection
