@extends('admin.layout.master')

@section('content')
		        <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">List Brands</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Brands</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
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
              @endif
        <!-- ============================================================== -->

        <form style="width: 80%;margin-left: 361px;" method="post">
            @csrf
          <div class="form-group">
            <label for="email"></label>
            <input style="width: 50%;display: inline-block;" type="text" class="form-control" id="email" name="brand">
            <button stype="submit" class="btn btn-default">Add Brands</button>
          </div>
         
        </form>
       <!-- ============================================================== -->   
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Brands</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getData as $key => $value)
                <tr>
                  <th scope="row">{{$value['id']}}</th>
                  <td>{{$value['brand']}}</td>
                  <td><a style="color: black;" href="brands/xoa/{{$value['id']}}">Delete</a></td>
                </tr> 
                @endforeach     
              </tbody>
            </table>
@endsection