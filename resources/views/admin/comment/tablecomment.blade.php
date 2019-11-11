@extends('admin.layout.master')

@section('content')
	<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">List Comment</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Comment</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <!-- ============================================================== -->
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
     <form method="post" action="{{url('admin/list/comment')}}"> 
     	@csrf    
	 <table class="table table-striped">
      <thead>
          <tr>
            <th scope="col">active</th>
            <th scope="col">Name Blog</th>
            <th scope="col">Conntent Comment</th>
            <th scope="col">Thời Gian Đăng</th>
            <th scope="col">Detele</th>
          </tr>
      </thead>
        <tbody>      	
		@foreach ($getBlog as $value)  
          	@foreach($getComment as $valueComment)
    			 @if($value['id'] == $valueComment['id_blog'])
    				  <tr>
                
                  <th scope="row"><input type="checkbox" name="active[]" value="{{$valueComment['id']}}" <?= $valueComment['active'] == 1 ? 'checked' : ''?>></th>

          			  <td scope="row">{{$value['name']}}</td>
			       		  <td scope="row">{{$valueComment['comment']}}</td>
			       		  <td scope="row">{{$valueComment['created_at']}}</td>
			            <td><a style="color: red;" href="{{url('admin/list/comment/'.$valueComment['id'])}}">Delete</a></td>
		          	</tr> 
    			@endif
    		@endforeach
        @endforeach
      </tbody>
    </table>
  	<button name="submit" style="margin-left: 480px;" type="submit">không hiển thị bình luận trên blog</button>
	</form>
@endsection

