@extends('frontend.layouts.master')

@section('content')
<section>
	<div class="container">
		<div class="row">
			<section id="form"><!--form-->
				<div class="container">
					<div class="row">
						<div class="col-sm-4" style="width: 69%; margin-left: 200px;" >
							<?php  
								$avatar = json_decode($getProduct['avatar']);
							?>
							@if(session('success'))
	                            <div class="alert alert-success alert-dismissible">
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
	                                {{session('success')}}
	                            </div>
	                        @endif
	                        @if($errors->any())
	                            <div class="alert alert-danger alert-dismissible">
	                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
	                                <ul>
	                                    @foreach($errors->all() as $error)
	                                        <li>{{$error}}</li>
	                                    @endforeach
	                                </ul>
	                            </div>
	                        @endif
							<div class="signup-form"><!--sign up form-->
								<h2>Update Product</h2>
								<form action="" method="POST" enctype="multipart/form-data">
									@csrf
									<p>Category:</p>
									<select name="category_id" style="margin-bottom: 10px; height: 40px;">
										@foreach ($getCategory as $valueCategory)
							     			@if ($getProduct['category_id'] == $valueCategory['id'])
							     			<option value="{{$valueCategory['id']}}">{{$valueCategory['category']}}</option>
							     			@endif
							     		@endforeach
									</select>
									<p>Brand:</p>
									<select name="brand_id" style="margin-bottom: 10px; height: 40px;">
										@foreach ($getBrand as $valueBrand)
							     			@if ($getProduct['brand_id'] == $valueBrand['id'])
							     			<option value="{{$valueBrand['id']}}">{{$valueBrand['brand']}}</option>
							     			@endif
							     		@endforeach					
									</select>
									<p>Size:</p>
									<select name="size_id" style="margin-bottom: 10px; height: 40px;">
										@foreach ($getSize as $valueSize)
							     			@if ($getProduct['size_id'] == $valueSize['id'])
							     			<option value="{{$valueSize['id']}}">{{$valueSize['size']}}</option>
							     			@endif
							     		@endforeach					
									</select>
									<p>Name Product:</p>
									<input type="text" placeholder="Name Product" name="product" value="{{$getProduct['product']}}" />
									<p>Price Product:</p>
									<input type="text" placeholder="Price" name="price" value="{{$getProduct['price']}}" />
									<p>Quantily Product:</p>
									<input type="number" placeholder="Quantily" name="quantily" value="{{$getProduct['quantily']}}" />
									<p>Select the delete picture</p>
									<div style="width: 100%; margin-bottom: 20px;">
										@foreach($avatar as $valueImage)
										<div style="width: 15%;float: left;">
											<img style="width: 90%;" src="{{ URL::to('upload/product/'.Auth::user()->id.'/'.$valueImage)}}">

										 	<input style="width: 16%; margin-left: 40px;" type="checkbox" name="active[]" value="{{$valueImage}}"> 
										</div>
										@endforeach
									</div>
									
									<input id="Image" type="file" name="avatar[]" multiple/>
									
									<textarea style="height: 100px; margin-bottom: 20px;" placeholder="Description" name="description" >{{$getProduct['description']}}</textarea>
									<button type="submit" class="btn btn-default">Update Product</button>
									
								</form>
							</div><!--/sign up form-->
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</section>
@endsection


