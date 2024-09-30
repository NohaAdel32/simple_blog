<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::get();
        return view('admin.comments.allPosts', compact('post'));
    }

    public function indexComment()
    {
        $comment = Auth::user()->comments;
        return view('admin.comments.comments', compact('comment'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.comments.add',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages=$this->messages();
        $data=$request->validate([
            'body' => 'required|string',
            'post_id' => 'required',
            ], $messages);
            $data['user_id']=auth()->user()->id;
           Comment::create($data);
           return redirect('user/comment')->with('success', 'Insert Comment Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $post =Post::with('comments')->findOrFail($id);
        return view('admin.comments.showDetails', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages=$this->messages();
        $data=$request->validate([
            'body' => 'required|string',
            'post_id' => 'required',
            ], $messages);
            Comment::where('id', $id)->update($data);
            return redirect('user/comment')->with('success', 'Edit Comment Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::where('id', $id)->delete();
        return redirect('user/comment')->with('danger', 'Delete Comment Success');
    }

    public function messages(){
        return[
            'body.required'=> 'should be text',
            'body.string'=> 'hould be text',
            
         ];

    }
}
