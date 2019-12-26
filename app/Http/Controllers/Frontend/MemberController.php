<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//gọi hàm để mã hoá password
use Illuminate\Support\Facades\Hash;
//gọi database
use App\Models\Country;
use App\Models\User;
use App\Models\History_oder;
//gọi requests
use App\Http\Requests\Frontend\MemberRegisterRequest;
use App\Http\Requests\Frontend\MemberloginRequest;
use App\Http\Requests\Frontend\UpdateProfileUser;
//gọi hàm kiểm tra đăng nhập
use Illuminate\Support\Facades\Auth;
//gọi hàm send mail
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
//goi ham session
use Session;

class MemberController extends Controller
{

    public function showLogin()
    {
        return view('frontend.member.login');
    }

    public function ShowRegister()
    {
        $getCountry = Country::all()->toArray();
        return view('frontend.member.register',compact('getCountry'));
    }

    public function register(MemberRegisterRequest $request)
    {
        $fileName = '';
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName('avatar');
            $file->move('upload/user/avatar/UserFrontend/',$fileName);

        }
        $data = $request->all();
        $data['avatar'] = $fileName;
        $data['password'] = Hash::make($request->password);
        $data['level'] = '0';

        if($user = User::create($data)){

            if (!empty(Session::get('cart'))){
                $information['user_id'] = $user['id'];
                $email = $user['email'];

                $cart = Session::get('cart');

                $data_user = User::where('id',$user['id'])->get();

                Mail::to($email)->send(new SendMailable($cart, $data_user));

                foreach ($cart as $key => $value) {
                    $information['product_name'] = $value['product'];
                    $information['avatar'] = $value['image'];
                    $information['quantily'] = $value['quantily'];
                    $information['price'] = $value['price'];

                    $save = History_oder::create($information);
                }

                if ($save) {
                    $request->session()->forget('cart');

                    return redirect('/');
                }
            }

            return redirect()->back()->with('success', __('Update profile success.'));
        }
    }

    public function login(MemberloginRequest $request)
    {
        $email = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email,'password' => $password])) {
            return redirect('/');
        }else{
            return redirect()->back()->withErrors('Đăng nhập thất bại vui lòng bạn kiểm tra lại thông tin đăng nhập');
        }
    }

    public function profile($id)
    {
        $data_user = User::findOrFail($id)->toArray();
        $data_country = Country::all()->toArray();
        return view('frontend.user.profile',compact('data_user','data_country'));
    }

    public function edit($id)
    {
        //
    }

    public function update(UpdateProfileUser $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->all();
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $data['password'] = Hash::make($request->password);
        }else{
            if (!empty($user['password'])) {
                $data['password'] = $user['password'];
            }
        }
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName('avatar');
            $data['avatar'] = $fileName;
        }
        //check forder có tồn tại hay không.
        if (!file_exists('upload/user/avatar/UserFrontend')) {
            //nếu không tồn tại thì tạo forder mới.
            mkdir('upload/user/avatar/UserFrontend');
        }
        if (!empty($file)) {
            //truyền biến $file vào thư mục.
            $file->move('upload/user/avatar/UserFrontend',$fileName);
            //xoá file avatar cũ.
            if (!empty($user['avatar'])) {
                $Path = 'upload/user/avatar/UserFrontend/'.$user['avatar'];
                if(!empty($Path)) {
                    unlink($Path);
                    if($user->update($data)){
                        return redirect()->back()->with('success', __('Update profile success.'));
                    }
                }
            }
        }else{
            $user->update($data);
            return redirect()->back()->with('success',__('Register profile success'));
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}


