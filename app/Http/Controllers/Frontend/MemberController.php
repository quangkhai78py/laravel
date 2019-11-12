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
            $file->move('upload',$fileName); 
        }
        $data = $request->all();
        $data['avatar'] = $fileName;
        $data['password'] = Hash::make($request->password);
        $data['level'] = '0';

        if($getIdUser = User::create($data)){
            $information['user_id'] = $getIdUser['id'];
            $cart = Session::get('cart');
            foreach ($cart as $key => $value) {
                $information['product_name'] = $value['product'];
                $information['quantily'] = $value['quantily'];
                $information['price'] = $value['price'];
                $save = History_oder::create($information);
            }
              
        });
            if ($save) {             
                    Session::flush();
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
