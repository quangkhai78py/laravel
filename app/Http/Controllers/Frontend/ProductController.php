<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Size;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Product;
use App\Models\Evaluate;
use App\Models\Cart;
use App\Models\Country;
use App\Models\History_oder;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests\Frontend\MemberProductRequest;
use App\Http\Requests\Frontend\UpdateProductRequest;
use App\Http\Requests\Frontend\SearchProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;
use Session;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view product details
    public function productDetails($id)
    {
        $productDetails = Product::findOrFail($id);
        $comment = Comment::where('product_id',$id)->whereNull('id_comment')->get();
        $replayComment = Comment::where('product_id',$id)->whereNotNull('id_comment')->get();
        $getEvaluate = Evaluate::select('evaluate')->where('product_id',$id)->get();

        $brand = Brands::all();
        return view('frontend.product.productDetails',compact('productDetails','brand','comment','replayComment','getEvaluate'));
    }
    // giải pháp thứ 2 cho replay comment
    public  function replayComment($id)
    {
        $show = '';
        $comment = Comment::where('product_id',$id)->whereNull('id_comment')->get();
        foreach ($comment as $key => $value) {
            $show .= '<li class="media" style="width: 412px;">
                            <a class="pull-left" href="#">
                                <img style="width: 50px;
                                height: 50px;" class="media-object" src="" alt="">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                    <li><i class="fa fa-clock-o"></i>'.$value['created_at'].'</li>
                                </ul>
                                <p>'.$value['comment'].'</p>
                                <a id="" class="btn btn-primary replay" href="#">
                                    <i class="fa fa-reply"></i>Replay
                                </a>
                            </div>
                        </li>';
        }
        echo $show;

        $replay = '';
        $comment = Comment::where('product_id',$id)->whereNull('id_comment')->get();
        $replay_comment = Comment::where('product_id',$id)->whereNotNull('id_comment')->get();
        foreach ($comment as $key => $value_comment) {
            foreach ($replay_comment as $key => $value_replay) {
                if ($value_replay['id_comment'] == $value_comment['id']) {
                    $replay .= '
                        <li class="media second-media" style="width: 412px; margin: 0px 100px; padding: 5px 5px 5px 5px;>
                                <a class="pull-left" href="#"><img style="width: 50px;
                                height: 50px;" class="media-object" src="'.url('upload/user/avatar/'.$value_comment['avatar']).'" alt=""></a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>Janis Gallagher</li>
                                    <li><i class="fa fa-clock-o"></i>
                                    '.$value_replay['created_at'].'</li>
                                </ul>
                                <p>'.$value_replay['comment'].'</p>
                                <a class="btn btn-primary" href="#replay"><i class="fa fa-reply"></i>Replay</a>
                            </div>
                        </li>';
                }
            }
        }

        echo $replay;
    }

    //view của giỏ hàng
    public function showCart()
    {
        $getProduct = Product::all();
        $getCountry = Country::all();
        return view('frontend.product.cart',compact('getProduct','getCountry'));
    }

    //cách thử 2 xử lý giỏ hàng bằng session thông qua models cart
    public function getProductCart($id)
    {
        $getProduct = Product::where('id', $id)->get();
        $cart = new Cart();
        $cart->addCart($id, $getProduct);
        return redirect('/');
    }

    //cách thứ 1 xử lý giỏ hàng bằng session thông qua ajax
    public function getCart(Request $request){
        $id = $request->getProduct_id;

        $getProduct = Product::where('id', $id)->get();

        foreach ($getProduct as $key => $value) {
            $product_price = $value['price'];
            $product_name = $value['product'];
            $product_image = $value['avatar'];
        }
        // $request->session()->flush();
        if (empty($request->session()->has('cart'))) {
            $cart[$id] = array(
                'id' => $id,
                'product' => $product_name,
                'price' => $product_price,
                'image' => $product_image,
                'quantily' => 1,
            );
        }else{
            $cart = $request->session()->get('cart');
            if (array_key_exists($id, $cart)) {
                $cart[$id] = array(
                    'id' => $id,
                    'product' => $product_name,
                    'price' => $product_price,
                    'image' => $product_image,
                    'quantily' => $cart[$id]['quantily'] + 1,
                );
            }else{
                $cart[$id] = array(
                    'id' => $id,
                    'product' => $product_name,
                    'price' => $product_price,
                    'image' => $product_image,
                    'quantily' => 1,
                );
            }
        }
        $tong = 0;

        foreach ($cart as $key => $value) {
            $tong += $cart[$key]['quantily'];
        }

        echo $tong;

        $request->session()->put('cart',$cart);

    }

    public function getCartProductDetails(request $request){
        $id = $request->id_productDetails;

        $get_Product = Product::where('id',$id)->get();

        foreach ($get_Product as $key => $value) {
            $product_price = $value['price'];
            $product_name = $value['product'];
            $product_image = $value['avatar'];
        }
        if (empty($request->session()->has('cart'))) {
            $cart[$id] = array(
                'id' => $id,
                'product' => $product_name,
                'price' => $product_price,
                'image' => $product_image,
                'quantily' => 1,
            );
        }else{
            $cart = $request->session()->get('cart');
            if (array_key_exists($id, $cart)) {
                $cart[$id] = array(
                    'id' => $id,
                    'product' => $product_name,
                    'price' => $product_price,
                    'image' => $product_image,
                    'quantily' => $cart[$id]['quantily'] + 1,
                );
            }else{
                $cart[$id] = array(
                    'id' => $id,
                    'product' => $product_name,
                    'price' => $product_price,
                    'image' => $product_image,
                    'quantily' => 1,
                );
            }
        }
        $tong = 0;

        foreach ($cart as $key => $value) {
            $tong += $cart[$key]['quantily'];
        }

        echo $tong;

        $request->session()->put('cart',$cart);
    }

    //delete session
    public function deleteCart($id)
    {
        if (!empty(Session::has('cart'))) {
            $cart = Session::get('cart');
            unset($cart[$id]);
            Session::put('cart',$cart);

        }

        return redirect()->back()->with('success', __('Delete success.'));
    }

    public function addCart(Request $request)
    {
        $id = $request->getProduct_id;
        $total = $request->product_price;
        $getProduct = Product::where('id', $id)->get();

        foreach ($getProduct as $key => $value) {
            $product_name = $value['product'];
            $product_price = $value['price'];
            $product_image = $value['avatar'];
        }
        $cart = $request->session()->get('cart');
        if (array_key_exists($id, $cart)) {
            $cart[$id] = array(
                'id' => $id,
                'product' => $product_name,
                'price' => $product_price,
                'image' => $product_image,
                'quantily' => $cart[$id]['quantily']+1,
                'total' =>$total,
            );
        }

        $request->session()->put('cart',$cart);

        $tong = 0;
        foreach ($cart as $key => $value) {
            $tong += $cart[$key]['quantily'];
        }
        echo $tong;
    }

    public function downCart(request $request)
    {
        $id = $request->getProduct_id;
        $total = $request->product_price;
        $getProduct = Product::where('id', $id)->get();

        foreach ($getProduct as $key => $value) {
            $product_name = $value['product'];
            $product_price = $value['price'];
            $product_image = $value['avatar'];
        }
        $cart = $request->session()->get('cart');
        if (array_key_exists($id, $cart)) {
            $cart[$id] = array(
                'id' => $id,
                'product' => $product_name,
                'price' => $product_price,
                'image' => $product_image,
                'quantily' => $cart[$id]['quantily']-1,
                'total' => $total,
            );
        }

        $request->session()->put('cart',$cart);

        $tong = 0;
        foreach ($cart as $key => $value) {
            $tong += $cart[$key]['quantily'];
        }

        echo $tong;
    }

    //xử lý lấy sản phẩm sau khi search
    public function getSearch(SearchProductRequest $request)
    {
        $product = Product::where('product','like','%'.$request->search.'%')
            ->orWhere('price',$request->search)
            ->paginate(9);

        return view('frontend.product.searchProduct',compact('product'));
    }

    public function postSearch(request $request)
    {
        $getValueSearch = $request->valueSearch;

        $array = (explode(' ', $getValueSearch));
        $product = Product::whereBetween('price', [$array[0], $array[2]])->get()->toArray();
        //return view('frontend.product.test',compact('product'));
        return response()->json(['success' => $product]);
    }

    //xử lý và lưu vào bản history oder
    public function historyTable(request $request)
    {
        $information['user_id'] = $request->getProduct_id;

        $cart = Session::get('cart');

        $data_user = User::where('id' ,$information['user_id'])->get();
        foreach ($data_user as $key => $value_user) {
            $email = $value_user['email'];
        }

        Mail::to($email)->send(new SendMailable($cart, $data_user));

        foreach ($cart as $key => $value) {
            $information['product_name'] = $value['product'];
            $information['quantily'] = $value['quantily'];
            $information['price'] = $value['price'];
            $information['avatar'] = $value['image'];

            History_oder::create($information);
        }

        $request->session()->forget('cart');

        return response()->json(['success'=>'Đặc hàng thành công!! Thank you.']);
    }

    //create comment
    public function comment(request $request)
    {

        $data = $request->all();
        $data['id_user'] = $_POST['user_id'];
        $data['comment'] = $_POST['cm_product'];
        $data['avatar'] = $_POST['avatar'];
        $data['product_id'] = $_POST['product_id'];

        if(Comment::create($data)){
            return response()->json(['success'=>'Cảm ơn bạn đã Comment']);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //view create product
    public function showProduct(){
        $product = Product::paginate(9);
        return view('frontend.product.product',compact('product'));

    }

    public function productRegister()
    {
        if (Auth::check()) {
            //get data from table category
            $getCategory = Category::all();
            //get data from table brands
            $getBrand = Brands::all();
            //get data from table size
            $getSize = Size::all();
            return view('frontend.product.createproduct.create',compact('getCategory','getBrand','getSize'));
        }else{
            return redirect('/');
        }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //hàm xử lý ảnh và cắt size ảnh
    public function HandlerImage($file)
    {
        //toàn bộ hàm upload ảnh và cắt ảnh save vào folder
        $ImageUpload = [];
        foreach($file as $image)
        {
            $name = strtotime(date('Y-m-d H:i:s')).'_'.$image->getClientOriginalName();

            $name_small = "small_".strtotime(date('Y-m-d H:i:s')).'_'.$image->getClientOriginalName();
            $name_larger = "larger_".strtotime(date('Y-m-d H:i:s')).'_'.$image->getClientOriginalName();

            if (!file_exists('upload/product/')) {
                mkdir('upload/product/');
            }
            $path = public_path('upload/product/' . $name);

            $path_small = public_path('upload/product/'. $name_small);
            $path_larger = public_path('upload/product/'. $name_larger);

            Image::make($image->getRealPath())->save($path);
            Image::make($image->getRealPath())->resize(84, 84)->save($path_small);
            Image::make($image->getRealPath())->resize(330, 380)->save($path_larger);

            $ImageUpload[] = $name;
        }
        return $ImageUpload;

    }

    //hàm xử lý create product
    public function create(MemberProductRequest $request)
    {

        if (Auth::check()) {
            $data = $request->all();
            $count = 0;
            if ($request->hasFile('avatar')) {
                $count = count($request->file('avatar'));
                if ($count > 5) {
                    return redirect()->back()->withErrors('vui lòng bạn chỉ nhập tối đa 5 ảnh');
                }else{

                    $file = $request->file('avatar');
                    //sử dụng lại hàm và truyền biến
                    $ImageUpload = $this->HandlerImage($file);
                    //
                    $data['user_id'] = Auth::user()->id;
                    $data['avatar'] = json_encode($ImageUpload);

                    if(Product::create($data)){
                        return redirect('/product/table/'.Auth::user()->id);
                    }
                }
            }
        }else{
            return redirect()->back()->withErrors('vui lòng đăng nhập');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //show table product
    public function ShowTable($id)
    {
        if (Auth::check()) {
            $getProduct_user = Product::where('user_id',$id)->get();

            $getCategory = Category::all();
            $getBrand = Brands::all();
            $getSize = Size::all();
            return view('frontend.product.createproduct.table',compact('getProduct_user','getCategory','getBrand','getSize'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //view show edit product
    public function ShowEdit($id)
    {
        if (Auth::check()) {
            //get data from table category
            $getCategory = Category::all();
            //get data from table brands
            $getBrand = Brands::all();
            //get data from table size
            $getSize = Size::all();
            //get data from table product forlow id
            $getProduct = Product::find($id);

            return view('frontend.product.createproduct.edit',compact('getProduct','getCategory','getBrand','getSize'));
        }else{
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //handle update product
    public function update(UpdateProductRequest $request, $id)
    {
        //lấy tất cả dữ liệu vào input
        $data = $request->all();
        //lấy dữ liệu input checkbox
        $getValueImage =$request->input('active');
        //lấy dư liệu sản phẩm id = id_edit trong bản product
        $getProduct = Product::findOrFail($id);
        //mã hoá chuổi avatar thành arr avatar
        $arrImage = json_decode($getProduct['avatar'], true);

        $countArrImage = 0;
        $countRequests = 0;
        //kiểm tra input có file
        if ($request->hasFile('avatar')) {
            //kiểm tra avatar cần xoá và xoá avatar trong array
            if (!empty($getValueImage)) {
                foreach ($arrImage as $key =>  $value) {

                    $name = $value;
                    $name_small = "small_".$value;
                    $name_larger = "larger_".$value;
                    //
                    $path = 'upload/product/'.$name;
                    $path_small = 'upload/product/'.$name_small;
                    $path_larger = 'upload/product/'.$name_larger;
                    if (in_array($value, $getValueImage)) {
                        unset($arrImage[$key]);
                        if (!empty($path)) {
                            unlink($path);
                            unlink($path_small);
                            unlink($path_larger);
                        }
                    }
                }
            }
            $countRequests = count($request->file('avatar'));
            $countArrImage = count($arrImage);
            //điều kiện không được upload quá 5 ảnh
            if (($countArrImage + $countRequests) > 5) {
                return redirect()->back()->withErrors('vui lòng bạn chỉ nhập tối đa 5 ảnh');
            }else{

                $file = $request->file('avatar');
                //sử dung lại hàm và truyền biến
                $ImageUpload = $this->HandlerImage($file);
                //hàm hợp nhất 2 mảng lại với nhau
                $merge = array_merge($arrImage,$ImageUpload);
                //hàm mã hoá array thành chuổi để lưu vào database
                $data['avatar'] = json_encode($merge);

            }

        }else{
            if (!empty($getValueImage)) {
                //
                foreach ($arrImage as $key =>  $value) {
                    $name = $value;
                    $name_small = "small_".$value;
                    $name_larger = "larger_".$value;
                    //
                    $path = 'upload/product/'.$name;
                    $path_small = 'upload/product/'.$name_small;
                    $path_larger = 'upload/product/'.$name_larger;
                    //
                    if (in_array($value, $getValueImage)) {
                        unset($arrImage[$key]);
                        if (!empty($path)) {
                            unlink($path);
                            unlink($path_small);
                            unlink($path_larger);
                        }
                    }
                }
                $stringImage = json_encode($arrImage);
                $data['avatar'] = $stringImage;
            }
        }

        if ($getProduct->update($data)) {

            return redirect()->back()->with('success', __('Update Product success.'));
        }

    }

    public function evaluate(request $request)
    {
        $data = $request->all();

        if (Evaluate::create($data)) {
            return response()->json(['success'=>'Cảm ơn bạn đã đánh giá']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //handle delete product and image in folder
    public function delete($id)
    {
        $delete = Product::find($id);

        if($delete->delete()){
            $arrImage = json_decode($delete['avatar']);
            if (!empty($arrImage)) {
                foreach ($arrImage as $value) {
                    $name = $value;
                    $name_small = "small_".$value;
                    $name_larger = "larger_".$value;
                    //
                    $path = 'upload/product/'.$name;
                    $path_small = 'upload/product/'.$name_small;
                    $path_larger = 'upload/product/'.$name_larger;
                    //
                    if(!empty($path) && !empty($path_small) && !empty($path_larger)) {
                        unlink($path);
                        unlink($path_small);
                        unlink($path_larger);
                    }
                }
            }
            return redirect()->back()->with('success', __('Delete product success.'));
        }else{
            return redirect()->back()->withErrors('Delete product error.');
        }
    }


}


