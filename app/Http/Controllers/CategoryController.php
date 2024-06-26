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
        $this->authorize('viewAny', Category::class);
        $categories = Category::all(); 
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);
            return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'required|image|max:2048',
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

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('view', Category::class);
            return view('categories.show', compact('category'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update', Category::class);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', Category::class);
            $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'required|image|max:2048',
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', Category::class);
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        }
}
