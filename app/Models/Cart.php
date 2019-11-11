<?php

namespace App\Models;
use Session;

class Cart 
{
    function addCart($id, $arrData)
    {    	
    	
    	$product_id = 0;
    	foreach ($arrData as $key => $value) 
    	{
    		$product_id = $value['id'];
    		$product_name = $value['product'];
    		$product_price = $value['price'];
    		$product_img = $value['avatar'];
    	}
   		if (empty(Session::has('cart'))) {
            $cart[$id] = array(
                'id' => $id,
                'product' => $product_name,
                'price' => $product_price,
                'avatar' => $product_img,
                'quantily' => 1,
            );
        } else{
	            $cart = Session::get('cart');
	            if (array_key_exists($id, $cart)) {
	                $cart[$id] = array(
	                'id' => $id,
	                'product' => $product_name,
	                'price' => $product_price,
	                'avatar' => $product_img,
	                'quantily' => $cart[$id]['quantily']+1,
	                );
	            }else{
	                $cart[$id] = array(
	                    'id' => $id,
	                    'product' => $product_name,
	                    'price' => $product_price,
	                    'avatar' => $product_img,
	                    'quantily' => 1,
	                );
	            }
	        }

		    Session::put('cart', $cart);
		
		//     public function destroyCart($id)
		//     {
		//         if (!empty(Session::get('cart'))) {
		//             $cart = Session::get('cart');
		//             unset($cart[$id]);
		//             Session::put('cart', $cart);

		//         }
		//     }
		
    	
    }
}
