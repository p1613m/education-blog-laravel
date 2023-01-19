<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registrationForm()
    {
        return view('registration');
    }

    public function registration(Request $request)
    {
        $userData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        User::query()->create([
            'password' => Hash::make($userData['password']),
        ] + $userData);

        return redirect()->route('login');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::attempt($loginData)) {
            return redirect()->route('home');
        }

        return back()
            ->withErrors(['email' => 'Incorrect user data'])
            ->withInput($request->all());
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
