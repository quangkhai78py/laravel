@extends('frontend.layouts.master')

@section('content')
	<table class="table" style="width: 1170px; margin-left: auto;margin-right: auto;">
	  <thead class="thead-dark">
	    <tr>
	      	<th style="text-align: center;" scope="col">Category</th>
	      	<th style="text-align: center;" scope="col">Brands</th>
	      	<th style="text-align: center;" scope="col">Size</th>
	      	<th style="text-align: center;" scope="col">Name Product</th>
	      	<th style="text-align: center;" scope="col">Price Product</th>
	      	<th style="text-align: center;" scope="col">Quantily Product</th>
	      	<th style="text-align: center;" scope="col">Avatar Product</th>
	      	<th style="text-align: center;" scope="col">Description</th>
	      	<th style="text-align: center;" scope="col">Edit</th>
	      	<th style="text-align: center;" scope="col">Delete</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	    	@foreach ($getProduct_user as $valueProduct)
	    	<?php
	    		$avatar = json_decode($valueProduct['avatar']);

	    	?>
    		@foreach ($getCategory as $valueCategory)
     			@if ($valueProduct['category_id'] == $valueCategory['id'])
     			<td style="text-align: center;">{{$valueCategory['category']}}</td>
     			@endif
     		@endforeach
     		@foreach ($getBrand as $valueBrand)
     			@if ($valueProduct['brand_id'] == $valueBrand['id'])
     			<td style="text-align: center;">{{$valueBrand['brand']}}</td>
     			@endif
     		@endforeach
			@foreach ($getSize as $valueSize)
     			@if ($valueProduct['size_id'] == $valueSize['id'])
     			<td style="text-align: center;">{{$valueSize['size']}}</td>
     			@endif
     		@endforeach
			<td style="text-align: center;">{{$valueProduct['product']}}</td>
			<td style="text-align: center;">{{number_format($valueProduct['price'])}}</td>
			<td style="text-align: center;">{{$valueProduct['quantily']}}</td>
			<td style="text-align: center;">
				@foreach ($avatar  as $valueImage)
					<img style="width: 50px;" src="{{ URL::to('upload/product/'.$valueImage)}}">
				@endforeach
			</td>
			<td style="text-align: center;">{{$valueProduct['description']}}</td>
			<td style="text-align: center;"><a href="{{url('/product/edit/'.$valueProduct['id'])}}">Edit</a></td>
			<td style="text-align: center;"><a href="{{url('/product/table/xoa/'.$valueProduct['id'])}}">Delete</a></td>
	    </tr>
	   @endforeach
	  </tbody>
	</table>


@endsection

