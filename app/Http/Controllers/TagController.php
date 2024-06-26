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
        $this->authorize('viewAny', Tag::class);
            $tags = Tag::all(); 
            return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Tag::class);
            return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tag::class);
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $tag = Tag::create([
                'name' => $request->name,
            ]);

            return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $this->authorize('view', Tag::class);
            return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', Tag::class);
            return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', Tag::class);
            $request->validate([
                'name' => 'required|string|max:255',
            ]);
          
            $tag->update([
                'name' => $request->name,
            ]);

            return redirect()->route('tags.index')->with('success', 'tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', Tag::class);
            $tag->delete();
            return redirect()->route('tags.index')->with('success', 'tag deleted successfully.');
    }
}
