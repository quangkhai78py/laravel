<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//gọi database Table blog
use App\Models\Blog;
use App\Models\Evaluate;
use App\Models\User;
//gọi database Table comment
use App\Models\Comment;
//gọi validate requests comment
use App\Http\Requests\Frontend\MemberCommentRequests;
use Illuminate\Database\QueryException;
//gọi Auth
use Auth;

class BlogConTroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        $getBlog = Blog::paginate(3);
        return view('frontend.blog.blog',compact('getBlog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SingleBlog($id)
    {   
        $getBlog = Blog::find($id);

        $getComment = Comment::where('id_blog',$id)->whereNull('id_comment')->get();

        $getReplayComment = Comment::where('id_blog',$id)->whereNotNull('id_comment')->get();

        $getEvaluate = Evaluate::select('evaluate')->where('blog_id',$id)->get();

        return view('frontend.blog.blogsingle',compact('getBlog','getComment','getReplayComment','getEvaluate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(MemberCommentRequests $request,$id)
    {
        if (Auth::check()) {
            $data = $request->all();
            $data['id_user'] = Auth::user()->id;
            $data['avatar'] = Auth::user()->avatar;
            $data['id_blog'] = $id;

            if(Comment::create($data)){           
               return redirect()->back()->with('success', __('Comment success.'));
            }
        }else{
            return redirect()->back()->withErrors('bạn vui lòng đăng nhập.');
        }
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxRequest(request $request)
    {
        
        if (Auth::check()) {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            if(Evaluate::create($data)){ 
            return response()->json(['success'=>'Cảm ơn bạn đã đánh giá']);
            }
        }else{
            return response()->json(['success'=>'vui lòng đăng nhập.']);
        } 

        
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
    public function destroy($id)
    {
        //
    }
}
