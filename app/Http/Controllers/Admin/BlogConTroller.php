<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//gọi Database
use App\Models\Blog;
//gọi requests check validate
use App\Http\Requests\Admin\BlogRequests;
use App\Http\Requests\Admin\UpdateBlogRequests;

class BlogConTroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        return view('admin.blog.blog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(BlogRequests $request)
    {
        $fileName = '';
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName('avatar');
            $file->move('upload/blog',$fileName); 
        }
        $data = $request->all();
        $data['avatar'] = $fileName;

        if(Blog::create($data)){           
             return redirect('admin/list/blog')->with('success', __('Create Blog Success.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ListBlog()
    {
        $getBlog = Blog::all()->toArray();
        return view('admin.blog.listblog',compact('getBlog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ShowEdit($id)
    {
        $getBlog = Blog::find($id);
        return view('admin.blog.edit',compact('getBlog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UpdateBlogRequests $request, $id)
    {
        $getBlog = Blog::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = $file->getClientOriginalName('avatar');
            $data['avatar'] = $fileName;                 
        }
        if ($getBlog->update($data)) {
            if (!empty($file)) {
                //truyền biến $file vào thư mục.
                $file->move('upload/user/avatar/',$fileName);    
            }                     
             return redirect('admin/list/blog')->with('success', __('Update Blog success.'));
        }else{
            return redirect()->back()->withErrors('Update Blog error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DeleteBlog($id)
    {
        $delete = Blog::find($id);        
        
        if($delete->delete()){
         return redirect()->back()->with('success', __('Delete success.'));
        }else{
            return redirect()->back()->withErrors('Delete error.');
        }
    }
}
