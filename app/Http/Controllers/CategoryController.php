<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->is_admin) {
            $categories = Category::all(); 
            return view('categories.index', compact('categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->is_admin) {
            return view('categories.create');
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
                'image' => 'image|max:2048',
            ]);
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
            }
            $category = Category::create([
                'name' => $request->name,
                'image' => $imageName,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if (Auth::user()->is_admin) {
            return view('categories.show', compact('category'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (Auth::user()->is_admin) {
            return view('categories.edit', compact('category'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (Auth::user()->is_admin) {
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'image|max:2048',
            ]);
            $imageName = $category->image;
            if ($request->hasFile('image')) {
                $image = $request["image"];
                $imageName = time() . "." . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
            }
            $category->update([
                'name' => $request->name,
                'image' => $imageName,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Auth::user()->is_admin) {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        }
    }
}
