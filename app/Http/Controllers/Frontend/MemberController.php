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
//gọi hàm kiểm tra đăng nhập
use Illuminate\Support\Facades\Auth;
//gọi hàm send mail
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
//goi ham session
use Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLogin()
    {
        return view('frontend.member.login');
    }

    public function ShowRegister()
    {
        $getCountry = Country::all()->toArray();
        return view('frontend.member.register',compact('getCountry'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(MemberRegisterRequest $request)
    {
        $fileName = '';
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName('avatar');
            $file->move('upload/user/avatar',$fileName);

        }
        $data = $request->all();
        $data['avatar'] = $fileName;
        $data['password'] = Hash::make($request->password);
        $data['level'] = '0';

        if($user = User::create($data)){

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

            return redirect()->back()->with('success', __('Update profile success.'));
        }
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}


