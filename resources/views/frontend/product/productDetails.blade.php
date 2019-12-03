@extends('frontend.layouts.master')

@section('content')

<section>
	<div class="container">
		<div class="row">
			@include('frontend.layouts.leftside')
			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<?php
								$avatar = json_decode($productDetails['avatar'], true);

							?>
								<img class="abc" src="{{URL::to('upload/product/'.$productDetails['user_id'].'/'.$avatar[0])}}" alt="" />
								<a class="abc" href="{{URL::to('upload/product/'.$productDetails['user_id'].'/larger_'.$avatar[0])}}" rel="prettyPhoto"><h3>ZOOM</h3></a>

						</div>
						<div id="similar-product" class="carousel slide" data-ride="carousel">
							  <!-- Wrapper for slides -->
						    <div class="carousel-inner">
								<div class="item active">
								 	@foreach ($avatar as $valueImage)
								  	<a href="#abc" ><img id="{{mb_substr($valueImage,0,16)}}"   src="{{URL::to('upload/product/'.$productDetails['user_id'].'/small_'.$valueImage)}}" alt=""></a>
								  	@endforeach
								</div>
								<div class="item">
								 	@foreach ($avatar as $valueImage)
								  	<a href="#abc"><img id="{{mb_substr($valueImage,0,16)}}" src="{{URL::to('upload/product/'.$productDetails['user_id'].'/small_'.$valueImage)}}" alt=""></a>
								  	@endforeach
								</div>
							</div>

						  <!-- Controls -->
							  	<a class="left item-control" href="#similar-product" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  	</a>
							  	<a class="right item-control" href="#similar-product" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  	</a>
						</div>

					</div>
					<div class="col-sm-7">
						<div class="product-information"><!--/product-information-->
							<img src=" {{asset('frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
							<h2>{{$productDetails['product']}}</h2>
								<?php
									$total = 0;
									foreach ($getEvaluate as $key => $value) {
										$total = $total + $value['evaluate'];

									}
									if ($total > 0) {
										$medium = $total/count($getEvaluate);
											$number = round($medium);

											if (isset($number) && !empty($number)) {
												for ($i = 1; $i <= 5 ; $i++) {
													if ($i <= $number) {
														echo '<span >
															<i class="fa fa-star color"></i>
															</span>';
													}else{
														echo '<i class="far fa-star"><input type="hidden" value="1"></i>';
														}
												}
											}
									}
								?>
							<span>
								<span>${{number_format($productDetails['price'])}}</span>
								<button id="{{$productDetails['id']}}" type="button" class="btn btn-fefault cart">
									<i class="fa fa-shopping-cart"></i>
									Add to cart
								</button>
							</span>
							<p><b>Availability:</b>
							{{ $productDetails['quantily'] > 0 ? 'in stock' : 'out of stock'}}
							</p>
							<p><b>Condition:</b> New</p>
							<p><b>Brand:</b>
							@foreach ($brand as $value)
								@if ($productDetails['brand_id'] == $value['id'])
									{{$value['brand']}}
								@endif
							@endforeach
							</p>
							<a href=""><img src=" {{asset('frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->

				<div class="category-tab shop-details-tab"><!--category-tab-->
					<div class="col-sm-12">
						<ul class="nav nav-tabs">
							<li><a href="#details" data-toggle="tab">Details</a></li>
							<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
							<li><a href="#tag" data-toggle="tab">Tag</a></li>
							<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane fade" id="details" >
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery1.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery2.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery3.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery4.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="companyprofile" >
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery1.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery3.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery2.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery4.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade" id="tag" >
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery1.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery2.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery3.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src=" {{asset('frontend/images/home/gallery4.jpg')}}" alt="" />
											<h2>$56</h2>
											<p>Easy Polo Black Edition</p>
											<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade active in" id="reviews" >

							<div class="col-sm-12">
								<ul>
									<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
									<li><a href=""><i class="fa fa-calendar-o"></i>{{$productDetails['created_at']}}</a></li>
								</ul>
								<div class="rating-area">
									<ul class="ratings">
										<li class="rate-this">Rating</li>
											<li>
												<i class="fa fa-star color"><input type="hidden" value="1"></i>
												<i class="fa fa-star color"><input type="hidden" value="2"></i>
												<i class="fa fa-star color"><input type="hidden" value="3"></i>
												<i class="fa fa-star color"><input type="hidden" value="4"></i>
												<i class="fa fa-star color"><input type="hidden" value="5"></i>
											</li>
										<li class="color">({{count($getEvaluate)}} votes)</li>
									</ul>
								</div>
								<p>{{$productDetails['description']}}</p>
								<p><b>Write Your Review</b></p>

								<div class="response-area">
									<ul class="media-list">
										<div id="show_comment">
										@foreach ($comment as $valueComment)
											<li class="media{{$valueComment['id']}}" style="width: 412px; margin: 0px 0px; padding: 5px 5px 5px 5px;">					<a class="pull-left" href="#">
					                                <img style="width: 50px;
					                                height: 50px;" class="media-object" src="{{URL::to('upload/user/avatar/'.$valueComment['avatar'])}}" alt="">
					                            </a>
					                            <div class="media-body">
					                                <ul class="sinlge-post-meta">
					                                    <li><i class="fa fa-user"></i>{{$valueComment['id_user']}}</li>
					                                    <li><i class="fa fa-clock-o"></i>{{$valueComment['created_at']}}</li>
					                                </ul>
					                                <p>{{$valueComment['comment']}}</p>
					                                <a id="{{$valueComment['id']}}" class="btn btn-primary replay" href="#replay">
					                                    <i id="" class="fa fa-reply"></i>Replay
					                                </a>
					                            </div>
					                        </li>
				                       		@foreach ($replayComment as $value_replay)
				                       			@if ($value_replay['id_comment'] == $valueComment['id'])

				                       			<div id="replay_comment{{$valueComment['id']}}" style="width: 420px; margin-left: 124px;">
					                       			<li  class="media second-media" style="width: 412px; margin:0px 0px; padding: 5px 5px 5px 5px;">
					                                    <a class="pull-left" href="#">
					                                        <img style="width: 50px;
					                                        height: 50px;" class="media-object" src="{{URL::to('upload/user/avatar/'.$value_replay['avatar'])}}" alt="">
					                                        </a>
					                                    <div class="media-body">
					                                        <ul class="sinlge-post-meta">
					                                            <li><i class="fa fa-user"></i>{{$value_replay['id_user']}}</li>
					                                            <li><i class="fa fa-clock-o"></i>
					                                            {{$value_replay['created_at']}}</li>
					                                        </ul>
					                                        <p>{{$value_replay['comment']}}</p>
					                                        <a class="btn btn-primary" href="#replay"><i class="fa fa-reply"></i>Replay</a>
					                                    </div>
					                                </li>
					                             </div>
				                                @endif
				                       			@endforeach
					               			@endforeach
										</div>
									</ul>
								</div>
								<div id="replay">
									<p class="msg"></p>
									<form action="" method="post">
										@csrf
										<input type="hidden" name="id_comment" value="" id="id_comment">
										<textarea id="cm_product" style="height: 100px; " name="" ></textarea>
										<button id="button" type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>

							</div>
						</div>

					</div>
				</div><!--/category-tab-->

				<div class="recommended_items"><!--recommended_items-->
					<h2 class="title text-center">recommended items</h2>

					<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src=" {{asset('frontend/images/home/recommend1.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src=" {{asset('frontend/images/home/recommend2.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src=" {{asset('frontend/images/home/recommend3.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src=" {{asset('frontend/images/home/recommend1.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src=" {{asset('frontend/images/home/recommend2.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src=" {{asset('frontend/images/home/recommend3.jpg')}}" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						  </a>
						  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
							<i class="fa fa-angle-right"></i>
						  </a>

					</div>
				</div><!--/recommended_items-->
			</div>
		</div>
	</div>
</section>


<script type="text/javascript">
    $(document).ready(function(){
    	$.ajaxSetup({
			 headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
    	$('button.btn-fefault').click(function(){

    		var getProduct_id = $(this).attr('id');

    		$.ajax({
    			url:'/product/cart',
                type: 'post',
                data:{
                    getProduct_id : getProduct_id,
                },
                dataType: 'json',
                success:function(data){
                    $('#cart').val(data);
                }
    		});
    	});

    });


	$(document).ready(function(){
		$.ajaxSetup({
			 headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
		$('button#button').click(function(){

			var cm_product = $('#cm_product').val();


			var checkUser = '<?= (isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? Auth::user()->id : '' ; ?>';

			if (checkUser !== '') {
				if (cm_product == '') {
					$('.msg').html("pleas enter comment");
				}else{

					var cm_product;

					var id_comment = $('#id_comment').val();
					var comment = '<?= (isset($valueComment['id']) && !empty($valueComment['id']) !== null)? $valueComment['id'] : '' ; ?>'
					var product_id = '<?php echo $productDetails['id']; ?>';
					var user_id = '<?= (isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? Auth::user()->id : '' ; ?>';

					var avatar = '<?= (isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? Auth::user()->avatar : '' ; ?>';

					$.ajax({
						url:'/comment/product/details/' + <?php echo $productDetails['id'] ?>,
						type: "post",
						data:{
							id_comment : id_comment,
							cm_product : cm_product,
							product_id : product_id,
							user_id : user_id,
							avatar : avatar,
						},
						dataType: 'json',
						success:function(data){
				            // alert(data.success);
				            $('.msg').html(data.success)
				            var html_comment = '<li class="media" style="width: 412px; margin: 0px 0px; padding: 5px 5px 5px 5px;">'+
							             			'<a class="pull-left" href="#">'+
												        '<img style="width: 50px;height: 50px;" class="media-object" src="<?=(isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? URL::to('upload/user/avatar/'.Auth::user()->avatar) : '' ; ?>">'+
												    '</a>'+
												    '<div class="media-body">'+
												        '<ul class="sinlge-post-meta">'+
												            '<li><i class="fa fa-user"></i>'+
												            '<?= (isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? Auth::user()->id : '' ; ?>'+
												            '</li>'+
												            '<li><i class="fa fa-clock-o"></i>'+'<?= (isset($valueComment['created_at']) && !empty($valueComment['created_at']) !== null)? $valueComment['created_at'] : ''; ?>'+
												            '</li>'+
												        '</ul>'+
												        '<p>'+cm_product+'</p>'+
												        '<a id="" class="btn btn-primary replay" href="#replay">'+
												            '<i class="fa fa-reply"></i>Replay</a>'+
												    '</div>'+
												'</li>';

							
							var html_comment_children ='<div style="width: 420px; margin-left: 124px; margin-bottom:10px;>'+
														'<li class="media second-media" style="width: 412px; margin:0px 0px; padding: 5px 5px 5px 5px;">'+
															'<a class="pull-left" href="#">'+
																'<img style="width: 50px;height: 50px;" class="media-object" src="<?=(isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? URL::to('upload/user/avatar/'.Auth::user()->avatar) : '' ; ?>" alt="">'+
															'</a>'+
															'<div class="media-body">'+
																'<ul class="sinlge-post-meta">'+
																	'<li><i class="fa fa-user"></i><?= (isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? Auth::user()->id : '' ; ?></li>'+
																	'<li><i class="fa fa-clock-o"></i><?= (isset($valueComment['created_at']) && !empty($valueComment['created_at']) !== null)? $valueComment['created_at'] : ''; ?>'+
																'</ul>'+
																'<p>'+cm_product+'</p>'+
																'<a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>'+
															'</div>'+
														'</li>'+
														'</div>';

							if (id_comment == '') {
								$('#show_comment').append(html_comment);
							}else{
								$('.media' + id_comment).append(html_comment_children);
							}
							//khi chạy xong xet lại value input bằng rổng
							$('#cm_product').val('');
						}
					});
				}
			}else{
				alert('vui lòng đăng nhập');
				//$('.msg').html("pleas enter comment");
			}
			//replayComment();

		});

		// replayComment();
		// function replayComment()
		// {
		// 	$.ajax({
		// 		url:'/getComment/'+<?php echo $productDetails['id'] ?>,
		// 		type: "get",
		// 		success:function(data){
		// 			$('#replay_comment').html(data);
		// 		}
		// 	});
		// }

		$(".replay").click(function(){
			var getValue = $(this).attr('id');
			$('#id_comment').val(getValue);

		});
	});
	$(document).ready(function(){

		$('img').click(function(){
		//get src of image
			var src = $(this).attr('src').split('/');
		//get name image in src
			var file = src[src.length - 1];
		//get name form str6 come str25
			var nameImage = file.substr(6, 25);
		//set src
			var image = '<?php echo URL::to('upload/product/'.$productDetails['user_id'].'/larger_')?>'+nameImage+'';
		//chèn srcImage vào class 'abc'
			var srcImage = $(".abc").attr("src",image);
			var srcImage = $(".abc").attr("href",image);
		});

	});

	$(document).ready(function(){
		$.ajaxSetup({
			 headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});

		$('.fa-star').click(function(){
			var checkUser = '<?= (isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? Auth::user()->id : ''; ?>';

			if (checkUser !== '') {
				var product_id = '<?php echo $productDetails['id'] ?>';
				var valueEvaluate = $(this).children('input').val();

				$.ajax({
					url:'/product/evaluate',
					type: 'post',
					data:{
						product_id : product_id,
						evaluate : valueEvaluate,
						user_id : checkUser,
					},
					dataType: 'json',
					success:function(data){
			            alert(data.success);
			        }
				});
			}else{
				alert('vui lòng đăng nhập');
			}

		});
	});

	$(document).ready(function(){
  		$("a[rel^='prettyPhoto']").prettyPhoto();
	});
</script>


@endsection
