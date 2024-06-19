<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            $tags = Tag::all(); 
            return view('tags.index', compact('tags'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->is_admin) {
            return view('tags.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->is_admin) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $tag = Tag::create([
                'name' => $request->name,
            ]);

            return redirect()->route('tags.index')->with('success', 'Tag created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        if (Auth::user()->is_admin) {
            return view('tags.show', compact('tag'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        if (Auth::user()->is_admin) {
            return view('tags.edit', compact('tag'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        if (Auth::user()->is_admin) {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
          
            $tag->update([
                'name' => $request->name,
            ]);

            return redirect()->route('tags.index')->with('success', 'tag updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        if (Auth::user()->is_admin) {
            $tag->delete();
            return redirect()->route('tags.index')->with('success', 'tag deleted successfully.');
        }
    }
}
