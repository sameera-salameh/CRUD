<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index (){
        $user = auth()->user(); 
        $users = User::whereNot('id' , auth()->id())->get();
        $categories = Category::all();
        $tags =Tag::all();
        $blockedUsers = $users->where('is_block', true)->sortBy('name');
        $unblockedUsers = $users->where('is_block', false)->sortBy('name');
        return view('dashboard' , compact('users' , 'tags', 'categories' , 'blockedUsers', 'unblockedUsers'));
    }

    public function createUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
    
        return redirect()->route('dashboard.index')->with('success', 'User added successfully');
    }
    
    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_block' => true]);
        return redirect()->route('dashboard.index')->with('success', 'User blocked successfully');
    }

    public function unblockUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_block' => false]);
        return redirect()->route('dashboard.index')->with('success', 'User unblocked successfully');
    }
}
