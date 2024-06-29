<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user=Auth::user();
            if($user->hasRole('admin')){
            $users = User::whereNot('id' , auth()->id())->get();
            $categories = Category::all();
            $tags =Tag::all();
            $blockedUsers = $users->where('is_block', true)->sortBy('name');
            $unblockedUsers = $users->where('is_block', false)->sortBy('name');
            return view('dashboard' , compact('users' , 'tags', 'categories' , 'blockedUsers' , 'unblockedUsers'));}
        }
    
        return back()->withErrors([
            'loginError' => 'Invalid credentials',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    public function showLoginForm(){
        return view('auth.login'); 
    }
}
