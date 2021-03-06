@extends('admin.layout.master')

@section('content')
	<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">List History Order</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">                              
                                    <li class="breadcrumb-item active" aria-current="page">History Order</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <!-- ============================================================== -->
	 <table class="table table-striped">
      <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên User</th>
            <th scope="col">Tên Product</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Quantily</th>
            <th scope="col">Total</th>
          </tr>
      </thead>
        <tbody> 
            @foreach ($getHistoryOrder as $valueOrder)
              @foreach ($getUser as $valueUser)
                @if($valueUser['id'] == $valueOrder['user_id'])
                   <?php $avatar = json_decode($valueOrder['avatar'], true); ?>
                  <tr>      
                    <td style="width: 50px;" scope="row">{{$valueOrder['id']}}</td>
                    <td style="width: 50px;" scope="row">{{$valueUser['name']}}</td>
                    <td style="width: 50px;" scope="row">{{$valueOrder['product_name']}}</td>
                    <td style="width: 50px;" scope="row"><img style="width: 50px;" src="{{URL::to('upload/product/'.$valueUser['id'].'/'.$avatar['0'])}}"></td>
                    <td style="width: 50px;" scope="row">{{number_format($valueOrder['price'])}}</td>
                    <td style="width: 50px;" scope="row">{{$valueOrder['quantily']}}</td>
                    <td style="width: 50px;" scope="row">
                    <?php 
                        $total = $valueOrder['price'] * $valueOrder['quantily'];
                        echo $total;
                    ?></td>
                  </tr>
                @endif
              @endforeach
            @endforeach
      </tbody>
    </table>
      <div style="text-align: center;">
        {{$getHistoryOrder->links()}}
      </div>
@endsection