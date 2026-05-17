<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function showRegister()
    {
        return view('admin.auth.register');
    }

    // REGISTER ADMIN
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('admin')->login($admin);

        return redirect()
            ->route('admin.login')
            ->with('success', 'Admin account created successfully!');
    }

    // LOGIN ADMIN
   public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Welcome back, Admin!');
    }

    return back()
        ->with('error', 'Invalid admin credentials')
        ->withInput();
}


    // LOGOUT ADMIN
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
           ->route('admin.login')
            ->with('success', 'Logged out successfully!');
    }
}
