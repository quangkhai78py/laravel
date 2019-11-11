@extends('frontend.layouts.master')

@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4" style="width: 69%;">
					<div class="signup-form" style="margin-left: 300px;"><!--sign up form-->
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
						<h2>New User Signup!</h2>
						<form action="{{url('/member/register')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<input type="text" placeholder="Name" name="name" />
							<input type="number" placeholder="Number" name="phone" />
							<input type="text" placeholder="Address" name="address" />
							<input type="file" name="avatar" />
							<select name="country" style="margin-bottom: 10px; height: 40px;">
								<option>Country</option>
								@foreach($getCountry as $value)
								<option value="{{$value['id']}}">{{$value['name']}}</option>
								@endforeach
							</select>
							<input type="email" placeholder="Email" name="email" />
							<input type="password" placeholder="Password" name="password" />
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
</section>
@endsection