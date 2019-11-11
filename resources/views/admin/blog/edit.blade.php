@extends('admin.layout.master')

@section('content')
	  <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Create Blog</h4>
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
        <form style="width: 50%;margin-left: 300px;" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <label for="email">Title Blog:</label>
            <input style="width: 100%;display: inline-block; margin-bottom: 20px;" type="text" class="form-control" id="email" name="name" value="{{$getBlog['name']}}">
            <label for="email">Avatar Blog:</label>
            <input style="width: 100%;display: inline-block;  margin-bottom: 20px;" type="file" class="form-control" id="email" name="avatar">
            <label for="email">Content Blog:</label>
            <textarea class="ckeditor" name="content" style="width: 100%;display: inline-block; height: 200px;">{{$getBlog['content']}}</textarea>
             <script type="text/javascript">
              CKEDITOR.replace( 'content', {
                filebrowserBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html') }}',
                filebrowserImageBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Images') }}',
                filebrowserFlashBrowseUrl: '{{ asset('editor/ckfinder/ckfinder.html?type=Flash') }}',
                filebrowserUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
                filebrowserImageUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
                filebrowserFlashUploadUrl: '{{ asset('editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
              });

            </script>
          </div>
         	<button stype="submit" class="btn btn-default">Add Blog</button>
        </form>
       <!-- ============================================================== -->   
         

@endsection