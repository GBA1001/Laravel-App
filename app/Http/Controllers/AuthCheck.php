<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Roles;

class AuthCheck 
{
   
    public function index()
    {
        if (!Auth::check()) {
            return view('login')->with('error', 'You must be logged in to access this page.');
        }
        return redirect()->route('post.list');  
    }

    public function login(Request $request){

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
            ]);
            return redirect()->route('post.list');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }
    public function registerUser(Request $request)
    {   
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),  
        ]);

        $role = Roles::create([
            'user_id' => $user->id, 
            'name' => 'user', 
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->put('user', [
                'id' => $user->id,
                'name' => $user->name,
            ]);
            return redirect()->route('post.list')->with('success', 'Registration successful!');
        } else {
            echo "else";
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }
    public function register(){
        return view('register');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
