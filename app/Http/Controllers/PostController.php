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
        return response()->json(['posts' => $posts]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
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
        return response()->json(['message' => 'Post added successfully']);
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return response()->json(['post' => $post]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if($this->authorize('update',  $post))
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
        return response()->json(['message' => 'Post updated successfully']);
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
        return response()->json(['message' => 'Post deleted successfully']);
    }
}
