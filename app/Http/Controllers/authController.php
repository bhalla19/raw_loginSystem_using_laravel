<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function homepage()
    {
        return view('homepage');
    }

    public function login()
    {
        return view('login');
    }

    public function loginDetails(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->with('message', 'Signed in!');
        }

        return redirect('/login')->with('message', 'Login details are not valid!');
    }

    public function register()
    {
        return view('register');
    }

    public function registerDetails(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard");
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect('/login');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }
}
