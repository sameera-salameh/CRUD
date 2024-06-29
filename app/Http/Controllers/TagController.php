<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasPermissions;

class TagController extends Controller
{
    use HasPermissions;
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
    public function create()
    {
              //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                  $request->validate([
                'name' => 'required|string|max:255',
            ]);
            $tag = Tag::create([
                'name' => $request->name,
            ]);

            return redirect()->route('dashboard.index')->with('success', 'Tag created successfully');
        }
    

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        
            return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
                $request->validate([
                'name' => 'required|string|max:255',
            ]);
          
            $tag->update([
                'name' => $request->name,
            ]);

            return redirect()->route('dashboard.index')->with('success', 'tag updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        
            $tag->delete();
            return redirect()->route('dashboard.index')->with('success', 'tag deleted successfully.');
    }}

