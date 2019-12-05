<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// call models
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;
// call Requests validate
use App\Http\Requests\Admin\UpdateProfileRequest;
use Auth;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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
        $getUser = User::find($id)->toArray();
        $getCountry = Country::All()->toArray();
        return view('admin.user.profile', compact('getUser','getCountry'));
        return view('admin.user.header', compact('getUser'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, $id)
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
        if ($user->update($data)) {
            //check forder có tồn tại hay không.
            if (!file_exists('upload/user/avatar/UserAdmin')) {
            //nếu không tồn tại thì tạo forder mới.
                mkdir('upload/user/avatar/UserAdmin');
            }
            if (!empty($file)) {
                //truyền biến $file vào thư mục.
                $file->move('upload/user/avatar/UserAdmin',$fileName);
                  //xoá file avatar cũ.
                    $getUser = Auth::user();
                    if (!empty($getUser['avatar'])) {
                         $Path = 'upload/user/avatar/UserAdmin/'.$getUser['avatar'];
                            if(!empty($Path)) {
                                unlink($Path);
                            }
                    }
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        }else{
            return redirect()->back()->withErrors('Update profile error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
