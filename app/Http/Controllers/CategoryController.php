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
        $categories = Category::all(); 
        return view('dashboard.index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'name' => 'required|string|max:255',
                'category_image' => 'required|image|max:2048',
            ]);
            $imageName = null;
            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
            }
            $category = Category::create([
                'name' => $request->name,
                'image' => $imageName,
            ]);

            return redirect()->route('dashboard.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
            return view('categories.show', compact('category'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
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

            return redirect()->route('dashboard.index')->with('success', 'category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
            $category->delete();
            return redirect()->route('dashboard.index')->with('success', 'Category deleted successfully.');
        }
}
