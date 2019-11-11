
@foreach ($product as $valueProduct)
<div class="col-sm-4">
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
				<?php
					$avatar = json_decode($valueProduct['avatar'], true);
				?>
				<img src="{{URL::to('upload/product/'.$valueProduct['user_id'].'/'.$avatar['0'])}}">
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