@extends('frontend.layouts.master')

@section('content')

	<section>
		<div class="container">
			<div class="row">
				<section id="form"><!--form-->
						<div class="container">
							<div class="row">
								<div class="col-sm-4" style="width: 69%; margin-left: 200px;" >
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
										<h2>Create Product</h2>
										<form action="{{url('/product/register')}}" method="POST" enctype="multipart/form-data">
											@csrf
											<p>Category:</p>
											<select name="category_id" style="margin-bottom: 10px; height: 40px;">
												<option></option>
												@foreach($getCategory as $valueCategory)
												<option value="{{$valueCategory['id']}}">{{$valueCategory['category']}}</option>
												@endforeach
											</select>
											<p>Brand:</p>
											<select name="brand_id" style="margin-bottom: 10px; height: 40px;">
												<option></option>
												@foreach($getBrand as $valueBrand)
												<option value="{{$valueBrand['id']}}">{{$valueBrand['brand']}}</option>
												@endforeach
											</select>
											<p>Size:</p>
											<select name="size_id" style="margin-bottom: 10px; height: 40px;">
												<option></option>
												@foreach($getSize as $valueSize)
												<option value="{{$valueSize['id']}}">{{$valueSize['size']}}</option>
												@endforeach
											</select>
											<p>Name Product:</p>
											<input type="text" placeholder="Name Product" name="product" />
											<p>Price Product:</p>
											<input type="text" placeholder="Price" name="price" />
											<p>Quantily Product:</p>
											<input type="number" placeholder="Quantily" name="quantily" />
											<p>Avatar Product:</p>
											<input id="Image" type="file" name="avatar[]" multiple/>
											<textarea style="height: 100px; margin-bottom: 20px;" placeholder="Description" name="description"></textarea>
											<button type="submit" class="btn btn-default">Create Product</button>
											
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
