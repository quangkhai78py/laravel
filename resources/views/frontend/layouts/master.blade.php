<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{asset('html/html-frontend/eshopper/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('html/html-frontend/eshopper/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('html/html-frontend/eshopper/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('html/html-frontend/eshopper/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('html/html-frontend/eshopper/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('html/html-frontend/eshopper/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('html/html-frontend/eshopper/css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="{{asset('html/html-frontend/eshopper/js/jquery.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/price-range.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('editor/ckeditor/ckeditor.js')}}"></script>      
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
</head><!--/head-->

<body>

	@include('frontend.layouts.header')
	
	@yield('content')

	@include('frontend.layouts.footer')

    <script src="{{asset('html/html-frontend/eshopper/js/jquery.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/price-range.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('html/html-frontend/eshopper/js/main.js')}}"></script>
	<script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('a').click(function(){
                var getProduct_id = $(this).attr('id');
                $.ajax({
                    url:'/product/cart',
                    type: 'post',
                    data:{
          
                        getProduct_id : getProduct_id,
                    },                   
                    dataType: 'json',
                    success:function(data){
                        $('#cart').val(data);                  
                    }
                });
            });
        });

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.slider-track').click(function(){
                var text_val = $('.tooltip').children('.tooltip-inner').text();
                
                $.ajax({
                    url:'/search/product',
                    type:'post',
                    data:{
                        valueSearch : text_val,
                    },
                    dataType:'json',
                    success:function(data)
                    {
                        var array = data.success;
                        var html = '';
                            $.map(array, function(value, index){            
                            var arrayImg = JSON.parse(value['avatar']);
                            html += '<div class="col-sm-4">' +
                                            '<div class="product-image-wrapper">'+
                                                '<div class="single-products">'+
                                                    '<div class="productinfo text-center">'+
                                                        '<img src="upload/product/'+value['user_id']+
                                                        '/'+arrayImg[0]+'">'+
                                                        '<h2>$'+value['price']+'</h2>'+
                                                        '<p>'+value['product']+'</p>'+
                                                        '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>'+
                                                    '</div>'+
                                                    '<div class="product-overlay">'+
                                                        '<div class="overlay-content">'+
                                                            '<h2>$'+value['price']+'</h2>'+
                                                            '<p>'+value['product']+'</p>'+
                                                            '<a id="'+value['id']+'"class="btn btn-default add-to-cart"><i  class="fa fa-shopping-cart"></i>Add to cart</a>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="choose">'+
                                                    '<ul class="nav nav-pills nav-justified">'+
                                                        '<li><a href="'+
                                                        '/product/details/'+
                                                        value['id']+
                                                        '"><i class="fa fa-plus-square"></i>Product Details</a></li>'+
                                                        '<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>'+
                                                    '</ul>'+
                                                '</div>'+
                                            '</div>'+
                                    '</div>';                       
                                $('#features_items').html(html);
                        });
                    }
                });
            });
            
        });
    </script>
</body>
</html>