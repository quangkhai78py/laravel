@extends('frontend.layouts.master')

@section('content')
	<section id="slider"><!--slider-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div id="slider-carousel" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
								<li data-target="#slider-carousel" data-slide-to="1"></li>
								<li data-target="#slider-carousel" data-slide-to="2"></li>
							</ol>

							<div class="carousel-inner">
								<div class="item active">
									<div class="col-sm-6">
										<h1><span>E</span>-SHOPPER</h1>
										<h2>Free E-Commerce Template</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
										<button type="button" class="btn btn-default get">Get it now</button>
									</div>
									<div class="col-sm-6">
										<img src="{{asset('html/html-frontend/eshopper/images/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
										<img src="{{asset('html/html-frontend/eshopper/images/home/pricing.png')}}"  class="pricing" alt="" />
									</div>
								</div>

								<div class="item">
									<div class="col-sm-6">
										<h1><span>E</span>-SHOPPER</h1>
										<h2>100% Responsive Design</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
										<button type="button" class="btn btn-default get">Get it now</button>
									</div>
									<div class="col-sm-6">
										<img src="{{asset('html/html-frontend/eshopper/images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
										<img src="{{asset('html/html-frontend/eshopper/images/home/pricing.png')}}"  class="pricing" alt="" />
									</div>
								</div>

								<div class="item">
									<div class="col-sm-6">
										<h1><span>E</span>-SHOPPER</h1>
										<h2>Free Ecommerce Template</h2>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
										<button type="button" class="btn btn-default get">Get it now</button>
									</div>
									<div class="col-sm-6">
										<img src="{{asset('html/html-frontend/eshopper/images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
										<img src="{{asset('html/html-frontend/eshopper/images/home/pricing.png')}}" class="pricing" alt="" />
									</div>
								</div>

							</div>

							<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>

					</div>
				</div>
			</div>
	</section><!--/slider-->
	<div class="container">
		<div class="row">
			@include('frontend.layouts.leftside')
			<div class="col-sm-9 padding-right">
				<div class="features_items" id="features_items"><!--features_items-->
					<h2 class="title text-center">Features Items</h2>
					@foreach ($product as $valueProduct)
					<div class="col-sm-3">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<?php
										$avatar = json_decode($valueProduct['avatar'], true);
									?>
									<img src="{{URL::to('upload/product/'.$avatar['0'])}}">
									<h2>${{number_format($valueProduct['price'])}}</h2>
									<p>{{$valueProduct['product']}}</p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
								</div>
								<div class="product-overlay">
									<div class="overlay-content">
										<h2>${{number_format($valueProduct['price'])}}</h2>
										<p>{{$valueProduct['product']}}</p>
										<a  id="{{$valueProduct['id']}}"class="btn btn-default add-to-cart"><i  class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
							</div>
							<div class="choose">
								<ul class="nav nav-pills nav-justified">
									<li><a href="{{url('/product/details/'.$valueProduct['id'])}}"><i class="fa fa-plus-square"></i>Product Details</a></li>
									<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
								</ul>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				<div style="text-align: center;">
					{{$product->links()}}
				</div>
			</div>
		</div>
	</div>
@endsection
