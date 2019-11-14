<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
	'namespace'=>'Frontend',
],function(){
	//route of Home
	Route::get('/','HomeController@index')->name('home');
	//route show login or register
	Route::get('/member/login','MemberController@showLogin')->name('showLogin');
	Route::get('/member/register','MemberController@ShowRegister')->name('ShowRegister');
	//route handle input login or register
	Route::post('/member/register','MemberController@register')->name('register');
	Route::post('/member/login','MemberController@login')->name('login');
	//route of logout
	Route::get('/logout','MemberController@logout')->name('logout');
	//route show blog
	Route::get('/blog','BlogConTroller@blog')->name('blog');
	//route show single-Blog
	Route::get('/single/blog/{id}','BlogConTroller@SingleBlog')->name('SingleBlog');
	//route of member comment
	Route::post('/single/blog/{id}','BlogConTroller@comment')->name('comment');
	//routue of evaluate
	Route::post('/ajax','BlogConTroller@ajaxRequest')->name('ajax.request');
	//route of product
	Route::get('/product/details/{id}','ProductController@productDetails')->name('product.details');

	//route of register product
	Route::get('/product','ProductController@showProduct')->name('show.product');
	Route::get('/product/register','ProductController@productRegister')->name('product.register');
	Route::post('/product/register','ProductController@create')->name('create.product');
	Route::get('/product/table/{id}','ProductController@ShowTable')->name('ShowTable.product');
	Route::get('/product/table/xoa/{id}','ProductController@delete')->name('delete.product');
	Route::get('/product/edit/{id}','ProductController@ShowEdit')->name('ShowEdit.product');
	Route::post('/product/edit/{id}','ProductController@update')->name('update.product');
	//route of comment product
	Route::post('/comment/product/details/{id}','ProductController@comment')->name('comment.product');

	//solution 2 cmt and replay
	// Route::get('/getComment/{id}','ProductController@replayComment')->name('replay.Comment');
	
	//route of evaluate product
	Route::post('/product/evaluate','ProductController@evaluate')->name('product.evaluate');
	//route of search product
	Route::get('/search/product','ProductController@getSearch')->name('get.Search.product');
	Route::post('/search/product','ProductController@postSearch')->name('post.search.product');
	//route of shoping cart
	Route::get('/product/cart','ProductController@showCart')->name('show.Cart');
	Route::post('/product/cart','ProductController@getCart')->name('get.Cart');
	Route::get('/product/cart/delete/{id}','ProductController@deleteCart')->name('delete.cart');
	Route::post('/product/addcart','ProductController@addcart')->name('add.cart.product');
	Route::post('/product/downcart','ProductController@downCart')->name('down.Cart.product');
	Route::get('/total/price/product','ProductController@totalPrice')->name('total.price.product');
	Route::post('add/member','MemberController@register')->name('add.member.register');
	Route::post('/history/table/cart','ProductController@historyTable')->name('history.table.cart');
	//Route::get('/product/cart/{id}','ProductController@getProductCart')->name('get.product.cart');

	//route of check out product
	Route::get('/checkout/product','ProductController@ShowcheckOutProduct')->name('Show.checkOut.Product');
});

//Admin
Auth::routes();

//login manager route
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Auth'
], function () {
    Route::get('/', 'LoginController@showLoginForm');
    Route::get('/login', 'LoginController@showLoginForm');
    // Route::post('/login', 'LoginController@login');
    // Route::get('/logout', 'LoginController@logout');
});

Route::group([
	'prefix'=>'admin',
	'namespace'=>'Admin',
	'middleware'=>['admin']
], function(){
	//
	Route::get('/dashboard','DashboardController@index')->name('admin.dashboard');
	//route of User
	Route::get('/user/profile/{id}','UserController@edit')->name('.admin.user.edit');
	Route::post('/user/profile/{id}','UserController@update')->name('admin.user.update');
	//route of country
	Route::get('/country/','CountryController@country')->name('admin.country.country');
	Route::post('/country','CountryController@create')->name('admin.country.create');
	Route::get('country/xoa/{id}','CountryController@delete')->name('admin.country.xoa');
	//route of blog
	Route::get('/blog','BlogConTroller@blog')->name('admin.blog');
	Route::post('/blog','BlogConTroller@create')->name('admin.create.blog');
	Route::get('/list/blog','BlogConTroller@ListBlog')->name('admin.list.blog');
	Route::get('/list/blog/xoa/{id}','BlogConTroller@DeleteBlog')->name('admin.Delete.blog');
	Route::get('/list/edit/blog/{id}','BlogConTroller@ShowEdit')->name('admin.ShowEdit.blog');
	Route::post('/list/edit/blog/{id}','BlogConTroller@edit')->name('admin.Edit.blog');
	//comment manager
	Route::get('/list/comment','CommentController@showComment')->name('show.comment');
	Route::post('/list/comment','CommentController@hiddenComment')->name('hidden.comment');
	Route::get('/list/comment/{id}','CommentController@DeleteComment')->name('Delete.Comment');
	//route of category
	Route::get('/category','CategoryController@category')->name('category');
	Route::post('/category','CategoryController@create')->name('create.category');
	Route::get('/category/xoa/{id}','CategoryController@delete')->name('delete.category');
	//route of brands
	Route::get('/brands','BrandsController@brands')->name('brands');
	Route::post('/brands','BrandsController@create')->name('create.brands');
	Route::get('/brands/xoa/{id}','BrandsController@delete')->name('delete.brand');
	//route of size
	Route::get('/size','SizeController@size')->name('size');
	Route::post('/size','SizeController@create')->name('size.create');
	Route::get('/size/xoa/{id}','SizeController@delete')->name('size.delete');
	//route of table history order
	Route::get('/history/table/cart','HistoryOderController@showHistoryTable')->name('show.history.table.cart');
});
