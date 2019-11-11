@extends('frontend.layouts.master')

@section('content')
	<section id="form"><!--form-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4" style="width: 69%;">
						<div class="login-form" style="margin-left: 300px;"><!--login form-->
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
							<h2>Login to your account</h2>
							<form method="POST" action="{{url('/member/login')}}">
								@csrf
								<input type="email" placeholder="Email Address" name="username" />
								<input type="password" placeholder="password" name="password" />
								<button type="submit" style="margin-right: 20px" class="btn btn-default">Login</button>
								<a href="{{url('/member/register')}}" class="btn btn-default">Register</a>
							</form>
							
						</div><!--/login form-->
					</div>
				</div>
			</div>
	</section>
@endsection
