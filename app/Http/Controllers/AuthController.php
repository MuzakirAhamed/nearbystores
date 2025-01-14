<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'userEmail' => 'required|email',
            'userPassword' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->input('userEmail'), 'password' => $request->input('userPassword')])) {
            $user = Auth::user();
            if ($user->role == '1') {
                return redirect()->route('store.index');
            } elseif ($user->role == '2') {
                return redirect()->route('dashboard');
            }
        }
        return back()->withErrors([
            'loginError' => 'Invalid email or password.',
        ])->withInput();
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('loginPage');
    }
}
