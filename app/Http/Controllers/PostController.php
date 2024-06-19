<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);
        $posts = Post::all();
        return view('posts.index')->with("posts", $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);
        $imagename = null;
        if ($request->hasFile('image')) {
            $image = $validatedData["image"];
            $imagename = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
        }
        $post = auth()->user()->posts()->create([
            "title" => $validatedData['title'],
            "description" => $validatedData['description'],
            "image" => $imagename,
            'category_id' => $validatedData['category_id'],
        ]);
        $post->tags()->sync($validatedData['tags']);
        return redirect()->route('posts.index')->with('success', 'Post add successfully ');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return view("posts.show")->with("post", $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $this->authorize('update', $post);

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update',  $post);
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|max:2048',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);
        $imagename = $post->image;

        if ($request->hasFile('image')) {
            $image = $validatedData["image"];
            $imagename = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
        }
        $post->update([
            "title" => $validatedData['title'],
            "description" => $validatedData['description'],
            "image" => $imagename,
            'category_id' => $validatedData['category_id'],
        ]);
        $post->tags()->sync($validatedData['tags']);
        return redirect()->route('posts.index')->with('success', 'Post updated successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->comments()->delete();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route("posts.index")->with('success');
    }
}
