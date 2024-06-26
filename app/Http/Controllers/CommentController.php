<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($postId)
    {
        $post = Post::findOrFail($postId); 
        $this->authorize('create', Comment::class);
        return view('comments.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create' , Comment::class);
        $validatedData = $request->validate([
            'content' => 'required',
            'post_id' => 'required', 
            ]
        );
        Comment::create([
            'content' => $validatedData['content'],
            'user_id' => auth()->id(),
            'post_id' => $request->post_id,
        ]);
        return redirect()->route('posts.show',['post' => $request->post_id])->with('success', 'Comment add successfully ');

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $this->authorize("update", $comment);
        return view('comments.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update',$comment);
    $validatedData = $request->validate([
        'content' => 'required',
    ]);

    $comment->update($validatedData);

    return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        
    $this->authorize('delete', $comment);

    $comment->delete();
    
    return back()->with('success', 'Comment deleted successfully');
    }
}
