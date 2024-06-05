<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with("posts", $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imagename = null;
        $post = new Post;
        if ($request->hasFile('image')) {
            $image = $request["image"];
            $imagename = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
        }
        $post->create([
            "title" => $request['title'],
            "description" => $request['description'],
            "image" => $imagename
        ]);
        return redirect()->route('posts.index')->with('success', 'Post add successfully ');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("posts.show")->with("post", $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit')->with("post", $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $imagename = $post->image;

        if ($request->hasFile('image')) {
            $image = $request["image"];
            $imagename = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
        }
        $post->update([
            "title" => $request['title'],
            "description" => $request['description'],
            "image" => $imagename
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("posts.index")->with('success');
    }
}
