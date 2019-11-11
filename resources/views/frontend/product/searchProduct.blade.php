
@extends('frontend.layouts.master')

@section('content')
	<section>
		<div class="container">
			<div class="row">
				@include('frontend.layouts.leftside')		
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>

						@foreach ($product as $value)
							<?php
								$avatar = json_decode($value['avatar'], true);
							?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="{{URL::to('upload/product/'.$value['user_id'].'/'.$avatar['0'])}}" alt="" />
										<h2>${{number_format($value['price'])}}</h2>
										<p>{{$value['product']}}</p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
									<div class="product-overlay">
										<div class="overlay-content">
											<h2>${{number_format($value['price'])}}</h2>
											<p>{{$value['product']}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="{{url('/product/details/'.$value['id'])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
						<div style="text-align: center;">
							{{$product->links()}}
						</div>
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
@endsection	