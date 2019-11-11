@extends('admin.layout.master')

@section('content')
	     <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">List Blog</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
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
	        <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Name Blog</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Detele</th>
                </tr>
              </thead>
              <tbody>
     		        @foreach ($getBlog as $value)
                  <tr>
                    <th scope="row">{{$value['id']}}</th>
                    <td>{{$value['name']}}</td>
                    <td><a style="color: blue;" href="edit/blog/{{$value['id']}}">Edit</a></td>
                    <td><a style="color: red;" href="blog/xoa/{{$value['id']}}">Delete</a></td>
                  </tr> 
                @endforeach     
              </tbody>
            </table>
             <div class="page-breadcrumb">
                <div class="row">
                    
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <button class="btn btn-default" style="margin-right: 50px;"><a href="{{url('admin/blog')}}" style="color: black; ">Add Blog</a> </button>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
       <!-- ============================================================== -->   
         

@endsection