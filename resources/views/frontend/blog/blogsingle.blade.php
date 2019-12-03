@extends('frontend.layouts.master')

@section('content')
	<section>
		<div class="container">
			<div class="row">
					@include('frontend.layouts.leftside')
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
							<h3>{{$getBlog['name']}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i>{{$getBlog['created_at']}}</li>
								</ul>
								<?php
									$tong = 0;

									foreach ($getEvaluate as $value) {
										$tong = $tong + $value['evaluate'];
									}
									if ($tong > 0) {
										$trung_binh = $tong/count($getEvaluate);
										$n = round($trung_binh);
										if (isset($n) && !empty($n)) {
											for ($i = 1; $i <= 5 ; $i++) {
												if ($i <= $n) {
													echo '<i class="fa fa-star"><input type="hidden" value=""></i>';
												}else{
													echo '<i class="far fa-star"><input type="hidden" value="1"></i>';
												}
											}

										}
									}
								?>
							</div>
							<a href="">
								<img style="width: 650px; height:370px;" src="{{ URL::to('upload/blog/'.$getBlog['avatar'])}}" alt="">
							</a>
							<p><?php echo $getBlog['content']?></p> <br>

							<div class="pager-area">
								<ul class="pager pull-right">
									<li><a href="#">Pre</a></li>
									<li><a href="#">Next</a></li>
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
								<i class="fa fa-star color"><input type="hidden" value="1"></i>
								<i class="fa fa-star color"><input type="hidden" value="2"></i>
								<i class="fa fa-star color"><input type="hidden" value="3"></i>
								<i class="fa fa-star color"><input type="hidden" value="4"></i>
								<i class="fa fa-star color"><input type="hidden" value="5"></i>
							</li>
							<li class="color">(6 votes)</li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="{{asset('html/html-frontend/eshopper/images/blog/socials.png')}}" alt=""></a>
					</div>
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
                        @endif<!--/socials-share-->
					<!--Comments-->

					<div class="response-area">
						<h2>3 RESPONSES</h2>
						<ul class="media-list">
							@foreach ($getComment as $value)
								@if($value['active'] == 0)
										<li class="media">
											<a class="pull-left" href="#">
												<img style="width: 50px;
												height: 50px;" class="media-object" src="{{ URL::to('upload/user/avatar/'.$value['avatar'])}}" alt="">
											</a>
											<div class="media-body">
												<ul class="sinlge-post-meta">
													<li><i class="fa fa-user"></i>Janis Gallagher</li>
													<li><i class="fa fa-clock-o"></i>{{$value['created_at']}}</li>
												</ul>
												<p>{{$value['comment']}}</p>
												<a id="{{$value['id']}}" class="btn btn-primary replay" href="#replay">
													<i class="fa fa-reply"></i>Replay
												</a>
											</div>
										</li>
									@endif
								@foreach ($getReplayComment as $valueReplay)

									@if ($valueReplay['id_comment'] == $value['id'])
										@if($valueReplay['active'] == 0)
											<li class="media second-media" >
												<a class="pull-left" href="#">
													<img style="width: 50px;
													height: 50px;" class="media-object" src="{{ URL::to('upload/user/avatar/'.$valueReplay['avatar'])}}" alt="">
													</a>
												<div class="media-body">
													<ul class="sinlge-post-meta">
														<li><i class="fa fa-user"></i>Janis Gallagher</li>
														<li><i class="fa fa-clock-o"></i>{{$valueReplay['created_at']}}</li>

													</ul>
													<p>{{$valueReplay['comment']}}</p>
													<a class="btn btn-primary" href="#replay"><i class="fa fa-reply"></i>Replay</a>
												</div>
											</li>
										@endif
									@endif
								@endforeach
							@endforeach
						</ul>
					</div>
					<!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-8">
								<div class="text-area">
									<div class="blank-arrow" id="replay">
										<label>Comment</label>
									</div>
									<span>*</span>
									<form method="post" action="">
									@csrf
										<input type="hidden" name="id_comment" value="" id="id_comment">
										<textarea style="height: 80px;" name="comment" rows="11"></textarea>
										<button id="btn" class="blank-arrow" type="submit" style="margin-right: 20px;
										margin-top: 20px;" class="btn btn-default">Bình Luận
										</button>
									</form>

								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
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

			$('.fa-star').click(function(){
				var CheckUser = '<?php (Auth::user() !== null)? Auth::user()->id : '' ; ?>';

				if (CheckUser !== null) {
					var getBlog_id = '<?php echo $getBlog['id']; ?>';
	              	var getValueAjax = $(this).children('input').val();


	          	 	$.ajax({
			            url : "/ajax",
			            type : "post",
			            data : {
			                evaluate : getValueAjax,
			                blog_id : getBlog_id,
			            },
			            success:function(data){
				            alert(data.success);

				        }
			        });
				}else{
					alert('vui lòng đăng nhập.!');
				};

		    });


		  	$(".replay").click(function(){
		  	//
			    var getValue = $(this).attr('id')
			    //
			  	$('input#id_comment').val(getValue);
		  });


		});

	</script>
@endsection

