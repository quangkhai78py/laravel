@extends('frontend.layouts.master')

@section('content')
	<section id="cart_items">	
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{url('/')}}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
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
  			<div class="container">	
			<div class="shopper-informations">
				<div class="row">
					<div >
						<?php
							if (isset(Auth::user()->id) && !empty(Auth::user()->id) !== null) {
								echo "";
							}else{
						?>
								<div class="shopper-info">
									<p>Shopper Information</p>
									<form id="form" style="width: 40%;display: inline-block;" method="post" action="{{url('add/member')}}"  enctype="multipart/form-data">
									@csrf
										<input id="name" type="text" placeholder="Name" name="name" />
										<input id="phone" type="number" placeholder="Number" name="phone" />
										<input id="address" type="text" placeholder="Address" name="address" />
										<input id="avatar" type="file" name="avatar" />
										<p style="font-size: 15px;">Country:</p>
										<select  id="country" name="country" style="margin-bottom: 10px; height: 40px;">
											<option></option>
											@foreach($getCountry as $value)
											<option value="{{$value['id']}}">{{$value['name']}}</option>
											@endforeach
										</select>
										<input id="email" type="email" placeholder="Email" name="email" />
										<input id="password" type="password" placeholder="Password" name="password" />
									</form>
								</div>
						<?php
							}
						?>
					</div>				
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>
		</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Product</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
						if (!empty(Session::get('cart'))) {
							$cart = Session::get('cart');
						}
						$totalPrice = 0;
					?>		

						@foreach ($getProduct as $valueProduct)
							@if(!empty($cart))
								@foreach ($cart as $valueCart)
									@if($valueCart['id'] == $valueProduct['id'])
									<tr>
										<?php
											$avatar = json_decode($valueProduct['avatar'], true);
										?>
										<td class="cart_product">
											<a href=""><img style="width: 150px;" src="{{URL::to('upload/product/'.$valueProduct['user_id'].'/'.$avatar['0'])}}"></a>
										</td>
										<td class="cart_description">
											<h4><a>{{$valueProduct['product']}}</a></h4>
										</td>
										<td class="cart_price">
											<p>${{number_format($valueProduct['price'])}}</p>
										</td>
										<td class="cart_quantity">
											<div  class="cart_quantity_button">
												<a id="{{$valueCart['id']}}" class="cart_quantity_up"> + </a>
												<input  class="cart_quantity_input" type="text" name="quantity" value="{{$valueCart['quantily']}}" autocomplete="off" size="2">
												<button style="width: 30px;height: 28px;" id="{{$valueCart['id']}}" class="cart_quantity_down" > - </button>
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">
										<?php
											if ($valueCart['quantily'] == 1) {
										?>		
												<input class="{{$valueProduct['id']}}" style="width: 200px; border: none;" type="text" value="{{$valueProduct['price']}}" name="">
												
										<?php	
											}else{
												$total = (($valueCart['quantily'])* ($valueProduct['price']));
										?>
											<input class="{{$valueProduct['id']}}" style="width: 200px; border: none;" type="text" value="{{$total}}" name="">
										<?php
												
											}
										?>			
											</p>
										</td>
										<td class="cart_delete">
											<a href="{{url('/product/cart/delete/'.$valueCart['id'])}}" class="cart_quantity_delete"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									<?php
										
										$totalPrice = $totalPrice + $valueCart['price'];
										
									?>
									@endif
								@endforeach
							@endif
						@endforeach
						@if(!empty($totalPrice))
							<tr>
								<td colspan="4">&nbsp;</td>
								<td colspan="4" style=" width: 272px;}" >
									<table class="table table-condensed total-result">
										<tr class="shipping-cost">
											<td style="width: 100px;">Shipping Cost</td>
											<td style="width: 100px;" >Free</td>				
										</tr>
										<tr>
											<td>Total</td>
											<td><span><input style="border: none;" id="totalPrice" value="<?= !empty($totalPrice)? $totalPrice : ''?>" type="text"></span></td>
										</tr>
										<tr>
											<td>
												<button type="submit" id="buyProduct">Mua Hàng</button>
											</td>
										</tr>
									</table>								
								</td>
							</tr>
						@endif
					</tbody>
				</table>
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

			$('.cart_quantity_button a').click(function(){
				var cart_quantity_input = $(this);
				var getProduct_id = $(this).attr('id');
				var getParent = $(this).parent();
				var totalPrice = parseInt($('#totalPrice').val());
				var getValue = parseInt(getParent.find('input').val());
				if ('<?php echo !empty($getProduct) ?>') {
					<?php foreach ($getProduct as $key => $value): ?>
						if (getProduct_id == '<?php echo $value['id'] ?>') {
							var getPrice = '<?php echo $value['price'] ?>';
							var getValueInput = $('.<?php echo $value['id'] ?>').val();
						}
					<?php endforeach ?>
					var total_product = parseInt(getPrice) + parseInt(getValueInput);

				}
				
				$.ajax({
					url:'/product/addcart',
                    type: 'post',
                    data:{
                    	product_price : total_product,
                        getProduct_id : getProduct_id,
                    },
                    dataType: 'json',
                    success:function(data){ 
                    
                    	var IntPrice = parseInt(getPrice);
                    	var IntPriceInput = parseInt(getValueInput); 
                    	var total = parseInt(IntPriceInput + IntPrice);
                    	var totalPriceCart = parseInt(IntPrice + totalPrice);
                    	$('#totalPrice').val(totalPriceCart);
                    	<?php foreach ($getProduct as $key => $value): ?>
						if (getProduct_id == '<?php echo $value['id'] ?>') {
							var getPriceTotal = $('.<?php echo $value['id'] ?>').val(total);
						}
						<?php endforeach ?> 

                    	if(cart_quantity_input.hasClass("cart_quantity_up")){
                    		getValue = getValue + 1;
                    		getParent.find('input').val(getValue);
                    	}                   	
                    }             
				});
			
			});

		
			$('.cart_quantity_button button').click(function(){
            	var cart_quantity_input = $(this);
				var getProduct_id = $(this).attr('id');

				var getParent = $(this).parent();
				var totalPrice = parseInt($('#totalPrice').val());
				var getValue = parseInt(getParent.find('input').val());

				if ('<?php echo !empty($getProduct) ?>') {
					<?php foreach ($getProduct as $key => $value): ?>
						if (getProduct_id == '<?php echo $value['id'] ?>') {
							var getPrice = '<?php echo $value['price'] ?>';
							var getValueInput = $('.<?php echo $value['id'] ?>').val();
						}
					<?php endforeach ?>
					var total_product = parseInt(getValueInput) - parseInt(getPrice);
					
				}
            	$.ajax({
            		url:'/product/downcart',
                    type: 'post',
                    data:{
                    	product_price : total_product,
                        getProduct_id : getProduct_id,
                    },
                    dataType: 'json',
                    success:function(data){  
                    	var IntPrice = parseInt(getPrice);
                    	var IntPriceInput = parseInt(getValueInput);         
                    	var total = parseInt(IntPriceInput - IntPrice);
						var totalPriceCart = parseInt(totalPrice - IntPrice);
						$('#totalPrice').val(totalPriceCart);
                    	<?php foreach ($getProduct as $key => $value): ?>
						if (getProduct_id == '<?php echo $value['id'] ?>') {
							$('.<?php echo $value['id'] ?>').val(total);
						}
						<?php endforeach ?>
                    	if(cart_quantity_input.hasClass("cart_quantity_down")){
                    		getValue = getValue - 1;
                    		getParent.find('input').val(getValue);
                    	}

                    	$('#cart').val(data);               	
                    }      
            	});
            	
            });
           
		});

		$(document).ready(function(){

			$('button#buyProduct').click(function(e){      		
       		var checkUser = '<?= (isset(Auth::user()->id) && !empty(Auth::user()->id) !== null)? Auth::user()->id : '' ; ?>';
       		var totalPrice = '<?= (!empty($totalPrice) !== null)? $totalPrice : '' ?>'; 

       		if (checkUser !== '') {
       			$.ajax({
            		url:'/history/table/cart',
                    type: 'post',
                    data:{
                    	totalPrice : totalPrice,
                        getProduct_id : checkUser,
                    },
                    dataType: 'json',
                    success:function(data){  
                    	alert('Bạn đã đặng hàng thành công');
                    }
                }); 
	       	}else{    			
       			var name = $('#name').val();
       			var phone = $('#phone').val();
       			var address = $('#address').val();
       			var avatar = $('#avatar').val();
       			var country = $('#country').val();
       			var email= $('#email').val();
       			var password = $('#password').val();
       	
       			if (name == '' && phone == '' && address == '' && avatar == '' && country == '' && email == '' && password == '') {
       				alert('bạn vui lòng đăng nhập nếu chưa có tài khoản!.. thì bạn có thể vui lòng nhập nhưng thông tin trên để đăng kí thành viên');
       			}else{
	       				if (name !== '') {
	       					var name = $('#name').val();
	       				}else{
	       					console.log('vui lòng nhập tên của bản');
	       				}

	       				if (phone !== '') {
	       					var phone = $('#phone').val();
	       				}else{
	       					console.log('vui lòng nhập số điện thoại của bạn');
	       				}

	       				if(address !== ''){
	       					var address = $('#address').val();
	       				}else{
	       					console.log('vui lòng nhập địa chỉ của bạn');
	       				}

	       				if (avatar !== '') {
	       					var avatar = $('#avatar').val();
	       				}else{
	       					console.log('vui lòng chọn hình ảnh');
	       				}

	       				if (country !== '') {
	       					var country = $('#country').val();
	       				}else{
	       					console.log('vui lòng chọn quốc gia');
	       				}

	       				if (email !== '') {
	   						var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
								if (testEmail.test(email)){
								    var email = $('#email').val();
								    console.log(email);
								}else{
									console.log('vui lòng nhập đúng email');
								}
								
	       				}else{
	       					console.log('vui lòng nhập email');
	       				}

	       				if(password !== ''){
	       					var password = $('#password').val();
	       				}else{
	       					console.log('vui lòng nhập password');
	       				}

	       				if (name !== '' && phone !== '' && address !== '' && avatar !== '' && country !== '' && email !== '' && password !== '') {

	       					e.preventDefault();
	   						$("#form").submit();
	       				}
       				}
	       		}

	       	});
		});

	</script>
@endsection