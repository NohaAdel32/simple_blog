<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->middleware('auth');
        $posts = Auth::user()->posts;
        return view('admin.posts.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
       return view('admin.posts.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $messages=$this->messages();
        $data=$request->validate([
            'title'=>'required|string|max:50',
            'body' => 'required|string',
            ], $messages);
            $data['user_id']=auth()->user()->id;
           Post::create($data);
           return redirect('user/listPost')->with('success', 'Insert Post Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages=$this->messages();
        $data=$request->validate([
            'title'=>'required|string|max:50',
            'body' => 'required|string',
            ], $messages);
           Post::where('id', $id)->update($data);
           return redirect('user/listPost')->with('success', 'Edit Post Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::where('id', $id)->delete();
        return redirect('user/listPost')->with('danger', 'Delete Data Success');
    }

    public function messages(){
        return[
            'title.required'=>'Title is Required',
            'title.string'=>'Should be string',
            'body.required'=> 'should be text',
            'body.string'=> 'hould be text',
            
         ];

    }
}
