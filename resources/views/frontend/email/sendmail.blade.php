<!DOCTYPE html>
<html>
<head lang="vi">
	<title>Đơn hàng</title>
	<meta charset="utf-8">
</head>
<body>	
	<div style="width: 100%; margin: 0px;
		padding: 0px;">
		<div style="width: 50%;margin-left: 330px;border-radius: 5px;border: 1px solid;">
			<div style="background: #FE980F;width: 100%;text-align: center;">
				<p style="width: 100%;font-size: 40px;font-weight: bolder;color: #fff;font-family: Arial;">Thank you for you order</p>
			</div>
			<div style="width: 100%;display: inline-block;">
				<div style="margin:20px 20px;">
					<p style="font-size: 15px;font-family: Arial;">Your order has been recelved and is now being processed. your order details are shown below for your referece</p>
					<div style="width: 100%;margin-top: 30px;margin-bottom: 20px;">
						<p style="font-size: 30px;font-weight: bolder;font-family: Arial;">Order:</p>
					</div>
					<div>				
						<table class="table" style="margin-left:auto;margin-right:auto;">
						<thead class="thead-dark">
						   <tr style="background-color: #f2f2f2;">
						    <th style="border: 1px solid #ddd;padding: 8px;">Iterm</th>
						    <th style="border: 1px solid #ddd; padding: 8px;">Product</th>
						    <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
						    <th style="border: 1px solid #ddd; padding: 8px;">Quantily</th>
						    <th style="border: 1px solid #ddd; padding: 8px;">Total</th>
						  </tr>
						</thead>
						<?php
							$tong = 0;
						?>
						@foreach($data as $valueProduct)
							<?php
								if (!empty($valueProduct['image'])) {
									$avatar = json_decode($valueProduct['image'], true);
								}
							?>	
							<tbody>					
						    	<td style="border: 1px solid #ddd; padding: 8px;">
						    	<img src="{{$message->embed('upload/product/'.$user_id.'/'.$avatar['0']) }}"style="width:100px;" />
						    	</td>		    
						    	<td style="border: 1px solid #ddd; padding: 8px;">{{$valueProduct['product']}}</td>
						    	<td style="border: 1px solid #ddd; padding: 8px;">{{$valueProduct['price']}}</td>
						    	<td style="border: 1px solid #ddd; padding: 8px;">{{$valueProduct['quantily']}}</td>
						    	<?php
						    		$priceProduct = $valueProduct['price'] * $valueProduct['quantily'];
						    	?>					   
						    	<td style="border: 1px solid #ddd; padding: 8px;">
						    	{{$priceProduct}}</td>
						    	<?php
						    		$tong = $tong + $priceProduct
						    	?>					   
					   		</tbody>
						@endforeach
					</table>
					</div>
					<div style="margin-top: 20px;width: 100%;display: inline-block;">
						<p style="width: 20%;margin-left: 300px;">Total Cart:{{$tong}}</p>
					</div>
					<div style="width: 100%;display: inline-block;margin-top: 10px;">
						<p style="font-size: 30px;font-weight: bolder;color: black;font-family: Arial;">Customer Detail:</p>
					</div>
					<div style="width: 100%;display: inline-block;">
						<p style="margin: 10px 0;">Email:<span>{{$email}}</span></p>
						<p style="margin: 10px 0;">Number-Phone:<span>{{$phone}}</span></p>
					</div>
				</div>
			</div>
			<div style="width: 100%;display: inline-block;">
				<div style="width: 100%;display: inline-block;text-align: center;margin-bottom: 20px;">
					<p style="width: 100%;display: inline-block;font-size: 30px;font-weight: bolder;color: black;font-family: Arial;">Thank you for your puschase.</p>
				</div>
				<div style="width: 100%;display: inline-block;text-align: center;">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>