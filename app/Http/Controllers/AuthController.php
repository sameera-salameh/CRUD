<?php

namespace App\Http\Controllers;
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
            return redirect()->route('posts.index');
        }
    
        return back()->withErrors([
            'loginError' => 'Invalid credentials',
        ]);
    }
    
    
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'image'
        ]);
        $imagename = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imagename);
            $validatedData['image'] = $imagename;
        }
            $validatedData['password'] = Hash::make($validatedData['password']);

    
        $user = User::create($validatedData);
        Auth::login($user);
        return redirect()->route('posts.index');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    public function showLoginForm(){
        return view('auth.login'); 
    }

    // Add this method to show the registration form
    public function showRegistrationForm(){
        return view('auth.register');
    }
}
